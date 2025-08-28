<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChemicalTestParameter;
use App\Models\SoilSample;
use App\Models\SoilRecommendation;

class SoilTestApiController extends Controller
{
    public function getParameters()
    {
        $parameters = ChemicalTestParameter::where('is_active', true)
            ->orderBy('parameter_name')
            ->get(['id', 'parameter_name', 'parameter_code', 'unit', 'description']);

        return response()->json($parameters);
    }

    public function getRecommendations(SoilSample $sample)
    {
        $recommendations = $sample->recommendations()
            ->orderBy('recommendation_type')
            ->get();

        return response()->json($recommendations);
    }

    public function generateReport(SoilSample $sample)
    {
        $sample->load(['farm', 'field', 'chemicalResults.parameter', 'recommendations', 'healthScore']);

        $reportData = [
            'sample' => $sample,
            'summary' => [
                'total_parameters' => $sample->chemicalResults->count(),
                'optimal_parameters' => $sample->chemicalResults->filter(fn($r) => $r->isOptimal() === true)->count(),
                'health_score' => $sample->healthScore?->overall_score,
                'recommendations_count' => $sample->recommendations->count()
            ]
        ];

        return response()->json($reportData);
    }
}
