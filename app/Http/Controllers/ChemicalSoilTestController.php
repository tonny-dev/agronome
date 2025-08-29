<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SoilTest;
use App\Models\Farm;
use App\Models\Field;
use App\Models\Vendor;
use App\Models\Kit;
use App\Models\SamplingPlan;
use App\Models\SampleLocation;
use App\Models\DepthResult;
use App\Models\Payment;
use App\Models\Returns;
use App\Models\ResultsRawAggregate;
use App\Models\FarmSoilTests;
use Carbon\Carbon;

class ChemicalSoilTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the main soil dashboard with farm selection
     */
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('farmer_id', $user->id)->with(['fields'])->get();
        
        // Get user's soil test history
        $soilTests = SoilTest::where('user_id', $user->id)
            ->with(['farm', 'vendor', 'kit'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate statistics
        $stats = [
            'total_tests' => SoilTest::where('user_id', $user->id)->count(),
            'completed_tests' => SoilTest::where('user_id', $user->id)->where('status', 'analysis_unlocked')->count(),
            'in_progress' => SoilTest::where('user_id', $user->id)->whereIn('status', ['picked_up', 'testing', 'awaiting_return'])->count(),
            'avg_farm_size' => $farms->avg('size_hectares') ?? 0
        ];

        return view('soil.chemical.dashboard', compact('farms', 'soilTests', 'stats'));
    }

    /**
     * Show farm details and initiate test creation
     */
    public function selectFarm(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        $farm = Farm::with(['fields'])->findOrFail($validated['farm_id']);
        
        // Verify user owns this farm
        if ($farm->farmer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to farm');
        }

        $field = null;
        if ($validated['field_id']) {
            $field = Field::findOrFail($validated['field_id']);
            if ($field->farm_id !== $farm->id) {
                abort(403, 'Field does not belong to selected farm');
            }
        }

        // Calculate sampling plan based on farm/field size
        $size = $field ? $field->size_hectares : $farm->size_hectares;
        $samplingPlan = $this->calculateSamplingPlan($size);

        return view('soil.chemical.farm-details', compact('farm', 'field', 'samplingPlan'));
    }

    /**
     * Show chemical test guide and proceed to vendor selection
     */
    public function showTestGuide(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'field_id' => 'nullable|exists:fields,id',
            'test_type' => 'required|in:chemical'
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        $field = $validated['field_id'] ? Field::findOrFail($validated['field_id']) : null;

        return view('soil.chemical.test-guide', compact('farm', 'field'));
    }

    /**
     * Show available vendors with kits near the farm location
     */
    public function showVendors(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        
        // Find vendors near the farm location (within 50km radius)
        $vendors = Vendor::select('vendors.*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$farm->centroid_lat, $farm->centroid_lng, $farm->centroid_lat]
            )
            ->with(['availableKits'])
            ->having('distance', '<', 50)
            ->orderBy('distance')
            ->get();

        // Filter vendors that have available kits
        $availableVendors = $vendors->filter(function($vendor) {
            return $vendor->availableKits->count() > 0;
        });

        return view('soil.chemical.vendor-selection', compact('farm', 'availableVendors'));
    }

    /**
     * Show calendar for booking test dates
     */
    public function showBookingCalendar(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'vendor_id' => 'required|exists:vendors,id',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        $vendor = Vendor::with(['availableKits'])->findOrFail($validated['vendor_id']);
        
        // Get unavailable dates for the vendor (already booked)
        $unavailableDates = SoilTest::where('vendor_id', $vendor->id)
            ->whereIn('status', ['paid', 'picked_up', 'testing'])
            ->pluck('pickup_at')
            ->map(function($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();

        // Calculate test pricing
        $pricing = $this->calculateTestPricing($farm, $validated['field_id']);

        return view('soil.chemical.booking-calendar', compact('farm', 'vendor', 'unavailableDates', 'pricing'));
    }

    /**
     * Create soil test booking
     */
    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'vendor_id' => 'required|exists:vendors,id',
            'field_id' => 'nullable|exists:fields,id',
            'pickup_date' => 'required|date|after:today',
            'allow_extra_day' => 'boolean'
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        $vendor = Vendor::findOrFail($validated['vendor_id']);
        
        // Check if vendor has available kits
        $availableKit = $vendor->availableKits()->first();
        if (!$availableKit) {
            return back()->withErrors(['vendor' => 'No available kits at selected vendor']);
        }

        // Calculate dates
        $pickupDate = Carbon::parse($validated['pickup_date']);
        $testingDate = $pickupDate->copy()->addDay();
        $dropoffDate = $testingDate->copy()->addDay();
        
        if ($validated['allow_extra_day'] ?? false) {
            $dropoffDate->addDay();
        }

        // Calculate pricing
        $pricing = $this->calculateTestPricing($farm, $validated['field_id']);

        DB::beginTransaction();
        try {
            // Reserve the kit
            $availableKit->update(['status' => 'held']);

            // Create soil test
            $soilTest = SoilTest::create([
                'user_id' => Auth::id(),
                'farm_id' => $validated['farm_id'],
                'vendor_id' => $validated['vendor_id'],
                'kit_id' => $availableKit->id,
                'field_id' => $validated['field_id'],
                'type' => 'chemical',
                'status' => 'booked',
                'pickup_at' => $pickupDate,
                'testing_at' => $testingDate,
                'dropoff_at' => $dropoffDate,
                'allow_extra_day' => $validated['allow_extra_day'] ?? false,
                'total_price' => $pricing['total'],
                'payment_status' => 'pending'
            ]);

            // Create sampling plan
            $size = $validated['field_id'] ? 
                Field::find($validated['field_id'])->size_hectares : 
                $farm->size_hectares;
            
            $samplingPlan = $this->createSamplingPlan($soilTest, $size);

            DB::commit();

            return redirect()->route('chemical-soil.payment', $soilTest->id);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['booking' => 'Failed to create booking. Please try again.']);
        }
    }

    /**
     * Show payment page
     */
    public function showPayment(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        $soilTest->load(['farm', 'vendor', 'field']);

        return view('soil.chemical.payment', compact('soilTest'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request, SoilTest $soilTest)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:mpesa,airtel',
            'phone_number' => 'required|regex:/^254[0-9]{9}$/'
        ]);

        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            // Create payment record
            $payment = Payment::create([
                'soil_test_id' => $soilTest->id,
                'gateway' => $validated['payment_method'],
                'amount' => $soilTest->total_price,
                'currency' => 'KES',
                'status' => 'initiated',
                'external_ref' => 'PAY_' . time() . '_' . $soilTest->id,
                'payload_json' => [
                    'phone_number' => $validated['phone_number'],
                    'amount' => $soilTest->total_price
                ]
            ]);

            // Update soil test status
            $soilTest->update([
                'payment_status' => 'initiated',
                'payment_ref' => $payment->external_ref
            ]);

            // Here you would integrate with actual payment gateway
            // For now, we'll simulate successful payment
            $this->simulatePaymentSuccess($payment, $soilTest);

            DB::commit();

            return redirect()->route('chemical-soil.confirmation', $soilTest->id)
                ->with('success', 'Payment processed successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['payment' => 'Payment processing failed. Please try again.']);
        }
    }

    /**
     * Show payment confirmation and pickup details
     */
    public function showConfirmation(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        $soilTest->load(['farm', 'vendor', 'kit', 'field']);

        return view('soil.chemical.confirmation', compact('soilTest'));
    }

    /**
     * User confirms kit pickup
     */
    public function confirmPickup(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$soilTest->canPickup()) {
            return back()->withErrors(['pickup' => 'Test is not ready for pickup']);
        }

        $soilTest->transitionTo('picked_up');
        $soilTest->kit->update(['status' => 'checked_out']);

        return redirect()->route('chemical-soil.testing', $soilTest->id)
            ->with('success', 'Kit pickup confirmed. You can now begin testing.');
    }

    /**
     * Show testing interface
     */
    public function showTesting(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        $soilTest->load(['samplingPlan', 'sampleLocations']);

        return view('soil.chemical.testing', compact('soilTest'));
    }

    /**
     * Start testing at a sample location
     */
    public function startLocationTesting(Request $request, SoilTest $soilTest)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:sample_locations,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'elevation' => 'nullable|numeric'
        ]);

        $location = SampleLocation::findOrFail($validated['location_id']);
        
        if ($location->soil_test_id !== $soilTest->id) {
            abort(403);
        }

        $location->update([
            'lat' => $validated['latitude'],
            'lng' => $validated['longitude'],
            'elevation_m' => $validated['elevation'],
            'status' => 'in_progress'
        ]);

        return response()->json(['success' => true, 'location' => $location]);
    }

    /**
     * Record test results for a depth at a location
     */
    public function recordDepthResult(Request $request, SoilTest $soilTest)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:sample_locations,id',
            'depth_type' => 'required|in:surface,sub_surface_30cm',
            'ambient_data' => 'required|array',
            'soil_data' => 'required|array',
            'device_timestamp' => 'required|date'
        ]);

        $location = SampleLocation::findOrFail($validated['location_id']);
        
        if ($location->soil_test_id !== $soilTest->id) {
            abort(403);
        }

        $depthResult = DepthResult::create([
            'sample_location_id' => $location->id,
            'depth_type' => $validated['depth_type'],
            'ambient_json' => $validated['ambient_data'],
            'soil_json' => $validated['soil_data'],
            'device_ts' => $validated['device_timestamp'],
            'sms_dispatch_status' => 'queued'
        ]);

        // Check if location is complete (both depths tested)
        $depthCount = DepthResult::where('sample_location_id', $location->id)->count();
        if ($depthCount >= 2) {
            $location->update(['status' => 'completed']);
            
            // Check if all locations are complete
            $totalLocations = $soilTest->sampleLocations()->count();
            $completedLocations = $soilTest->sampleLocations()->where('status', 'completed')->count();
            
            if ($completedLocations >= $totalLocations) {
                $soilTest->transitionTo('awaiting_return');
            }
        }

        // Simulate SMS dispatch
        $this->dispatchResultSMS($depthResult);

        return response()->json([
            'success' => true,
            'location_complete' => $location->status === 'completed',
            'test_complete' => $soilTest->fresh()->status === 'awaiting_return'
        ]);
    }

    /**
     * Show return interface
     */
    public function showReturn(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        $soilTest->load(['vendor', 'kit', 'returns']);

        return view('soil.chemical.return', compact('soilTest'));
    }

    /**
     * Confirm kit return
     */
    public function confirmReturn(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        if ($soilTest->status !== 'awaiting_return') {
            return back()->withErrors(['return' => 'Test is not ready for return']);
        }

        // Create return record
        Returns::create([
            'soil_test_id' => $soilTest->id,
            'user_confirmed' => true,
            'confirmed_at' => now()
        ]);

        $soilTest->transitionTo('returned');
        $soilTest->kit->update(['status' => 'diagnostics']);

        return redirect()->route('chemical-soil.results', $soilTest->id)
            ->with('success', 'Kit returned successfully. Results will be available once diagnostics are complete.');
    }

    /**
     * Show test results
     */
    public function showResults(SoilTest $soilTest)
    {
        if ($soilTest->user_id !== Auth::id()) {
            abort(403);
        }

        $soilTest->load([
            'sampleLocations.depthResults',
            'resultsRawAggregate',
            'returns'
        ]);

        // Check if results are unlocked
        if ($soilTest->status !== 'analysis_unlocked') {
            return view('soil.chemical.results-locked', compact('soilTest'));
        }

        return view('soil.chemical.results', compact('soilTest'));
    }

    // Helper Methods

    private function calculateSamplingPlan($sizeHectares)
    {
        // Calculate number of sample points based on farm size
        if ($sizeHectares <= 1) {
            $sampleCount = 3;
        } elseif ($sizeHectares <= 5) {
            $sampleCount = 5;
        } elseif ($sizeHectares <= 10) {
            $sampleCount = 8;
        } else {
            $sampleCount = min(12, ceil($sizeHectares / 2));
        }

        return [
            'sample_count' => $sampleCount,
            'recommended_pattern' => $sampleCount <= 5 ? 'random' : 'grid',
            'farm_size' => $sizeHectares
        ];
    }

    private function calculateTestPricing($farm, $fieldId = null)
    {
        $size = $fieldId ? Field::find($fieldId)->size_hectares : $farm->size_hectares;
        $samplingPlan = $this->calculateSamplingPlan($size);
        
        $basePrice = 2000; // Base price for chemical test
        $perSamplePrice = 500; // Additional cost per sample location
        
        $subtotal = $basePrice + ($samplingPlan['sample_count'] * $perSamplePrice);
        $tax = $subtotal * 0.16; // 16% VAT
        $total = $subtotal + $tax;

        return [
            'base_price' => $basePrice,
            'sample_count' => $samplingPlan['sample_count'],
            'per_sample_price' => $perSamplePrice,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ];
    }

    private function createSamplingPlan($soilTest, $sizeHectares)
    {
        $planData = $this->calculateSamplingPlan($sizeHectares);
        
        $samplingPlan = SamplingPlan::create([
            'soil_test_id' => $soilTest->id,
            'sample_count' => $planData['sample_count'],
            'plan_json' => $planData
        ]);

        // Create sample locations
        for ($i = 1; $i <= $planData['sample_count']; $i++) {
            SampleLocation::create([
                'soil_test_id' => $soilTest->id,
                'seq_no' => $i,
                'lat' => 0, // Will be updated during testing
                'lng' => 0, // Will be updated during testing
                'status' => 'pending'
            ]);
        }

        return $samplingPlan;
    }

    private function simulatePaymentSuccess($payment, $soilTest)
    {
        // In production, this would be handled by payment gateway callback
        $payment->update([
            'status' => 'confirmed',
            'external_ref' => 'CONF_' . time()
        ]);

        $soilTest->update([
            'payment_status' => 'confirmed',
            'status' => 'paid'
        ]);

        $soilTest->kit->update(['status' => 'checked_out']);
    }

    private function dispatchResultSMS($depthResult)
    {
        // Simulate SMS dispatch - in production, integrate with SMS gateway
        $depthResult->update(['sms_dispatch_status' => 'sent']);
    }
}