<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SoilSample;
use App\Models\ChemicalTestParameter;
use App\Models\SoilChemicalResult;
use App\Models\SoilRecommendation;
use App\Models\SoilHealthScore;
use App\Models\Farm;
use App\Models\Field;

class SoilTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $samples = SoilSample::with(['farm', 'field', 'healthScore'])
            ->where('user_id', Auth::id())
            ->orderBy('collection_date', 'desc')
            ->paginate(10);

        return view('soil.index', compact('samples'));
    }

    public function create()
    {
        $farms = Farm::where('farmer_id', Auth::id())->get();
        return view('soil.create', compact('farms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'field_id' => 'nullable|exists:fields,id',
            'collection_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'depth_cm' => 'required|integer|min:5|max:100',
            'weather_conditions' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000'
        ]);

        $sample = SoilSample::create([
            ...$validated,
            'user_id' => Auth::id(),
            'sample_code' => $this->generateSampleCode($validated['farm_id']),
            'status' => 'collected'
        ]);

        return redirect()->route('soil.show', $sample)
            ->with('success', 'Soil sample recorded successfully!');
    }

    public function show(SoilSample $sample)
    {
        $sample->load(['farm', 'field', 'chemicalResults.parameter', 'recommendations', 'healthScore']);
        
        return view('soil.show', compact('sample'));
    }

    public function addResults(Request $request, SoilSample $sample)
    {
        $validated = $request->validate([
            'results' => 'required|array',
            'results.*.parameter_id' => 'required|exists:chemical_test_parameters,id',
            'results.*.result_value' => 'required|numeric',
            'lab_reference' => 'nullable|string|max:100',
            'test_date' => 'required|date'
        ]);

        foreach ($validated['results'] as $result) {
            SoilChemicalResult::create([
                'sample_id' => $sample->id,
                'parameter_id' => $result['parameter_id'],
                'result_value' => $result['result_value'],
                'lab_reference' => $validated['lab_reference'],
                'test_date' => $validated['test_date'],
                'status' => 'completed'
            ]);
        }

        // Generate recommendations and health score
        $this->generateRecommendations($sample);
        $this->calculateHealthScore($sample);

        $sample->update(['status' => 'results_received']);

        return redirect()->route('soil.show', $sample)
            ->with('success', 'Test results added successfully!');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total_samples' => SoilSample::where('user_id', $user->id)->count(),
            'pending_results' => SoilSample::where('user_id', $user->id)
                ->whereIn('status', ['collected', 'sent_to_lab'])->count(),
            'avg_health_score' => SoilHealthScore::whereHas('sample', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->avg('overall_score'),
            'recent_samples' => SoilSample::with(['farm', 'healthScore'])
                ->where('user_id', $user->id)
                ->orderBy('collection_date', 'desc')
                ->limit(5)->get()
        ];

        return view('soil.dashboard', compact('stats'));
    }

    private function generateSampleCode($farmId)
    {
        $count = SoilSample::where('farm_id', $farmId)->count() + 1;
        return 'SS-' . $farmId . '-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    private function generateRecommendations(SoilSample $sample)
    {
        $results = $sample->chemicalResults()->with('parameter')->get();
        
        foreach ($results as $result) {
            $parameter = $result->parameter;
            
            // Generate recommendations based on parameter values
            if ($parameter->parameter_code === 'PH' && $result->result_value < 6.0) {
                SoilRecommendation::create([
                    'sample_id' => $sample->id,
                    'recommendation_type' => 'lime',
                    'product_name' => 'Agricultural Lime',
                    'quantity_per_hectare' => 2.0,
                    'unit' => 'tons',
                    'application_method' => 'Broadcast and incorporate into soil',
                    'timing' => 'before_planting',
                    'estimated_cost' => 15000
                ]);
            }
            
            if ($parameter->parameter_code === 'N' && $result->result_value < $parameter->optimal_min) {
                SoilRecommendation::create([
                    'sample_id' => $sample->id,
                    'recommendation_type' => 'fertilizer',
                    'product_name' => 'Urea (46-0-0)',
                    'quantity_per_hectare' => 100,
                    'unit' => 'kg',
                    'application_method' => 'Side dress application',
                    'timing' => 'during_growth',
                    'estimated_cost' => 8000
                ]);
            }
        }
    }

    private function calculateHealthScore(SoilSample $sample)
    {
        $results = $sample->chemicalResults()->with('parameter')->get();
        
        $phScore = $this->calculateParameterScore($results, 'PH');
        $nutrientScore = $this->calculateNutrientScore($results);
        $organicMatterScore = $this->calculateParameterScore($results, 'OM');
        
        $overallScore = ($phScore + $nutrientScore + $organicMatterScore) / 3;
        
        $interpretation = $this->getHealthInterpretation($overallScore);
        
        SoilHealthScore::create([
            'sample_id' => $sample->id,
            'overall_score' => $overallScore,
            'ph_score' => $phScore,
            'nutrient_score' => $nutrientScore,
            'organic_matter_score' => $organicMatterScore,
            'interpretation' => $interpretation
        ]);
    }

    private function calculateParameterScore($results, $parameterCode)
    {
        $result = $results->firstWhere('parameter.parameter_code', $parameterCode);
        
        if (!$result || !$result->parameter->optimal_min || !$result->parameter->optimal_max) {
            return 50; // Default score if no reference
        }
        
        $value = $result->result_value;
        $min = $result->parameter->optimal_min;
        $max = $result->parameter->optimal_max;
        
        if ($value >= $min && $value <= $max) {
            return 100;
        } elseif ($value < $min) {
            return max(0, 100 - (($min - $value) / $min * 100));
        } else {
            return max(0, 100 - (($value - $max) / $max * 100));
        }
    }

    private function calculateNutrientScore($results)
    {
        $nutrients = ['N', 'P', 'K'];
        $scores = [];
        
        foreach ($nutrients as $nutrient) {
            $scores[] = $this->calculateParameterScore($results, $nutrient);
        }
        
        return count($scores) > 0 ? array_sum($scores) / count($scores) : 50;
    }

    private function getHealthInterpretation($score)
    {
        return match(true) {
            $score >= 80 => 'Excellent soil health. Continue current management practices.',
            $score >= 60 => 'Good soil health. Minor improvements may be beneficial.',
            $score >= 40 => 'Fair soil health. Consider implementing recommended improvements.',
            $score >= 20 => 'Poor soil health. Immediate action required to improve soil conditions.',
            default => 'Very poor soil health. Comprehensive soil management program needed.'
        };
    }
}
