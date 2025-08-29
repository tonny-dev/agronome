<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleLocation extends Model
{
    protected $fillable = [
        'soil_test_id', 'seq_no', 'lat', 'lng', 'elevation_m', 'status'
    ];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
        'elevation_m' => 'decimal:2',
    ];

    public function soilTest()
    {
        return $this->belongsTo(SoilTest::class);
    }

    public function depthResults()
    {
        return $this->hasMany(DepthResult::class);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function canStart($currentSeq)
    {
        return $this->seq_no === $currentSeq && $this->status === 'pending';
    }
}
