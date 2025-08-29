<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\Kit;
use App\Models\Farm;
use App\Models\User;
use App\Models\SoilTest;
use App\Models\SamplingPlan;
use App\Models\SampleLocation;
use App\Services\SamplingPlanFactory;

class SoilTestingSeeder extends Seeder
{
    public function run()
    {
        // Create vendors
        $vendors = [
            [
                'name' => 'Nairobi Agro-Vet Center',
                'location_admin_code' => 'NRB001',
                'location_name' => 'Nairobi Central',
                'lat' => -1.2921,
                'lng' => 36.8219,
                'contact' => '+254700123456'
            ],
            [
                'name' => 'Kiambu Extension Office',
                'location_admin_code' => 'KMB001', 
                'location_name' => 'Kiambu Town',
                'lat' => -1.1748,
                'lng' => 36.8356,
                'contact' => '+254700234567'
            ],
            [
                'name' => 'Machakos Agricultural Center',
                'location_admin_code' => 'MCK001',
                'location_name' => 'Machakos Town',
                'lat' => -1.5177,
                'lng' => 37.2634,
                'contact' => '+254700345678'
            ]
        ];

        foreach ($vendors as $vendorData) {
            $vendor = Vendor::create($vendorData);
            
            // Create 5-8 kits per vendor with mixed statuses
            $kitCount = rand(5, 8);
            for ($i = 1; $i <= $kitCount; $i++) {
                $status = match ($i) {
                    1, 2, 3 => 'available',
                    4 => 'checked_out',
                    5 => 'held',
                    default => 'available'
                };

                Kit::create([
                    'vendor_id' => $vendor->id,
                    'status' => $status,
                    'serial_no' => "KIT-{$vendor->id}-" . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'last_diagnostics_at' => now()->subDays(rand(1, 30))
                ]);
            }
        }

        // Update existing farms with required fields
        $farms = Farm::take(5)->get();
        foreach ($farms as $index => $farm) {
            $farm->update([
                'location_admin_code' => "FARM-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'location_name' => $farm->name . " Area",
                'centroid_lat' => -1.2921 + (rand(-100, 100) / 1000),
                'centroid_lng' => 36.8219 + (rand(-100, 100) / 1000),
                'size_hectares' => rand(1, 20) + (rand(0, 99) / 100),
                'details_json' => [
                    'soil_type' => ['clay', 'loam', 'sandy'][rand(0, 2)],
                    'irrigation' => rand(0, 1) ? 'rain-fed' : 'irrigated',
                    'slope' => ['flat', 'gentle', 'steep'][rand(0, 2)]
                ]
            ]);
        }

        // Create 2 historical soil tests
        $user = User::first();
        if ($user && $farms->count() >= 2) {
            // Completed test
            $completedTest = SoilTest::create([
                'user_id' => $user->id,
                'farm_id' => $farms[0]->id,
                'vendor_id' => $vendors[0]['id'] ?? 1,
                'kit_id' => 1,
                'type' => 'chemical',
                'status' => 'analysis_unlocked',
                'pickup_at' => now()->subDays(10),
                'testing_at' => now()->subDays(9),
                'dropoff_at' => now()->subDays(7),
                'allow_extra_day' => false,
                'total_price' => 2500.00,
                'payment_status' => 'confirmed',
                'payment_ref' => 'PAY-' . uniqid()
            ]);

            // Create sampling plan for completed test
            $planData = SamplingPlanFactory::fromFarmSize($farms[0]);
            $samplingPlan = SamplingPlan::create([
                'soil_test_id' => $completedTest->id,
                'sample_count' => $planData['sample_count'],
                'plan_json' => $planData
            ]);

            // Create sample locations
            foreach ($planData['locations'] as $location) {
                SampleLocation::create([
                    'soil_test_id' => $completedTest->id,
                    'seq_no' => $location['seq_no'],
                    'lat' => $farms[0]->centroid_lat + ($location['relative_x'] - 0.5) * 0.01,
                    'lng' => $farms[0]->centroid_lng + ($location['relative_y'] - 0.5) * 0.01,
                    'elevation_m' => 1200 + rand(-100, 100),
                    'status' => 'completed'
                ]);
            }

            // In-progress test
            SoilTest::create([
                'user_id' => $user->id,
                'farm_id' => $farms[1]->id,
                'vendor_id' => $vendors[1]['id'] ?? 2,
                'kit_id' => 2,
                'type' => 'chemical',
                'status' => 'paid',
                'pickup_at' => now()->addDay(),
                'testing_at' => now()->addDays(2),
                'dropoff_at' => now()->addDays(4),
                'allow_extra_day' => true,
                'total_price' => 2500.00,
                'payment_status' => 'confirmed',
                'payment_ref' => 'PAY-' . uniqid()
            ]);
        }

        $this->command->info('Soil testing demo data seeded successfully!');
    }
}
