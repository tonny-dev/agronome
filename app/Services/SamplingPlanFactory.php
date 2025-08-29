<?php

namespace App\Services;

use App\Models\Farm;

class SamplingPlanFactory
{
    public static function fromFarmSize(Farm $farm): array
    {
        $hectares = $farm->size_hectares ?? 1;
        
        // Calculate sample count based on farm size
        $sampleCount = match (true) {
            $hectares <= 1 => 3,
            $hectares <= 5 => 5,
            $hectares <= 10 => 8,
            $hectares <= 20 => 12,
            default => 15
        };

        // Generate sampling locations in a grid pattern
        $locations = [];
        $gridSize = ceil(sqrt($sampleCount));
        
        for ($i = 0; $i < $sampleCount; $i++) {
            $row = intval($i / $gridSize);
            $col = $i % $gridSize;
            
            // Calculate relative positions (0-1) within farm boundaries
            $relativeX = ($col + 0.5) / $gridSize;
            $relativeY = ($row + 0.5) / $gridSize;
            
            $locations[] = [
                'seq_no' => $i + 1,
                'relative_x' => $relativeX,
                'relative_y' => $relativeY,
                'description' => "Sample point " . ($i + 1)
            ];
        }

        return [
            'sample_count' => $sampleCount,
            'locations' => $locations,
            'farm_size_hectares' => $hectares
        ];
    }
}
