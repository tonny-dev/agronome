<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamplingPlan extends Model
{
    protected $fillable = [
        'soil_test_id', 'sample_count', 'plan_json'
    ];

    protected $casts = [
        'plan_json' => 'array',
    ];

    public function soilTest()
    {
        return $this->belongsTo(SoilTest::class);
    }
}
