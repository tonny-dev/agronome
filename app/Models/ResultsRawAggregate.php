<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultsRawAggregate extends Model
{
    protected $fillable = [
        'soil_test_id', 'aggregate_json', 'locked_until_return'
    ];

    protected $casts = [
        'aggregate_json' => 'array',
        'locked_until_return' => 'boolean',
    ];

    public function soilTest()
    {
        return $this->belongsTo(SoilTest::class);
    }
}
