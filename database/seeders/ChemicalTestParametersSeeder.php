<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChemicalTestParameter;

class ChemicalTestParametersSeeder extends Seeder
{
    public function run()
    {
        $parameters = [
            [
                'parameter_name' => 'pH Level',
                'parameter_code' => 'PH',
                'unit' => 'pH units',
                'optimal_min' => 6.0,
                'optimal_max' => 7.5,
                'test_method' => 'Potentiometric',
                'description' => 'Soil acidity/alkalinity level affecting nutrient availability'
            ],
            [
                'parameter_name' => 'Nitrogen (N)',
                'parameter_code' => 'N',
                'unit' => 'mg/kg',
                'optimal_min' => 20.0,
                'optimal_max' => 50.0,
                'test_method' => 'Kjeldahl method',
                'description' => 'Essential macronutrient for plant growth and chlorophyll production'
            ],
            [
                'parameter_name' => 'Phosphorus (P)',
                'parameter_code' => 'P',
                'unit' => 'mg/kg',
                'optimal_min' => 15.0,
                'optimal_max' => 30.0,
                'test_method' => 'Olsen method',
                'description' => 'Critical for root development and energy transfer'
            ],
            [
                'parameter_name' => 'Potassium (K)',
                'parameter_code' => 'K',
                'unit' => 'mg/kg',
                'optimal_min' => 100.0,
                'optimal_max' => 200.0,
                'test_method' => 'Ammonium acetate extraction',
                'description' => 'Important for water regulation and disease resistance'
            ],
            [
                'parameter_name' => 'Organic Matter',
                'parameter_code' => 'OM',
                'unit' => '%',
                'optimal_min' => 2.0,
                'optimal_max' => 5.0,
                'test_method' => 'Walkley-Black method',
                'description' => 'Improves soil structure, water retention, and nutrient availability'
            ],
            [
                'parameter_name' => 'Calcium (Ca)',
                'parameter_code' => 'CA',
                'unit' => 'mg/kg',
                'optimal_min' => 800.0,
                'optimal_max' => 2000.0,
                'test_method' => 'Ammonium acetate extraction',
                'description' => 'Essential for cell wall development and soil structure'
            ],
            [
                'parameter_name' => 'Magnesium (Mg)',
                'parameter_code' => 'MG',
                'unit' => 'mg/kg',
                'optimal_min' => 120.0,
                'optimal_max' => 300.0,
                'test_method' => 'Ammonium acetate extraction',
                'description' => 'Central component of chlorophyll molecule'
            ],
            [
                'parameter_name' => 'Sulfur (S)',
                'parameter_code' => 'S',
                'unit' => 'mg/kg',
                'optimal_min' => 10.0,
                'optimal_max' => 25.0,
                'test_method' => 'Turbidimetric method',
                'description' => 'Important for protein synthesis and oil production'
            ],
            [
                'parameter_name' => 'Iron (Fe)',
                'parameter_code' => 'FE',
                'unit' => 'mg/kg',
                'optimal_min' => 4.5,
                'optimal_max' => 15.0,
                'test_method' => 'DTPA extraction',
                'description' => 'Essential for chlorophyll synthesis and enzyme function'
            ],
            [
                'parameter_name' => 'Zinc (Zn)',
                'parameter_code' => 'ZN',
                'unit' => 'mg/kg',
                'optimal_min' => 1.0,
                'optimal_max' => 3.0,
                'test_method' => 'DTPA extraction',
                'description' => 'Critical for enzyme activation and growth regulation'
            ],
            [
                'parameter_name' => 'Manganese (Mn)',
                'parameter_code' => 'MN',
                'unit' => 'mg/kg',
                'optimal_min' => 5.0,
                'optimal_max' => 15.0,
                'test_method' => 'DTPA extraction',
                'description' => 'Important for photosynthesis and nitrogen metabolism'
            ],
            [
                'parameter_name' => 'Copper (Cu)',
                'parameter_code' => 'CU',
                'unit' => 'mg/kg',
                'optimal_min' => 0.2,
                'optimal_max' => 1.0,
                'test_method' => 'DTPA extraction',
                'description' => 'Essential for enzyme systems and lignin synthesis'
            ],
            [
                'parameter_name' => 'Boron (B)',
                'parameter_code' => 'B',
                'unit' => 'mg/kg',
                'optimal_min' => 0.5,
                'optimal_max' => 2.0,
                'test_method' => 'Hot water extraction',
                'description' => 'Critical for cell wall formation and reproductive development'
            ],
            [
                'parameter_name' => 'Electrical Conductivity',
                'parameter_code' => 'EC',
                'unit' => 'dS/m',
                'optimal_min' => 0.0,
                'optimal_max' => 2.0,
                'test_method' => 'Conductivity meter',
                'description' => 'Indicates soil salinity levels affecting plant growth'
            ]
        ];

        foreach ($parameters as $parameter) {
            ChemicalTestParameter::create($parameter);
        }
    }
}
