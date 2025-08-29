<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepthResult extends Model
{
    protected $fillable = [
        'sample_location_id', 'depth_type', 'ambient_json', 'soil_json', 
        'device_ts', 'sms_dispatch_status'
    ];

    protected $casts = [
        'ambient_json' => 'array',
        'soil_json' => 'array',
        'device_ts' => 'datetime',
    ];

    public function sampleLocation()
    {
        return $this->belongsTo(SampleLocation::class);
    }
}
