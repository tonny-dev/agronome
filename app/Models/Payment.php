<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'soil_test_id', 'gateway', 'amount', 'currency', 'status', 
        'external_ref', 'payload_json'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payload_json' => 'array',
    ];

    public function soilTest()
    {
        return $this->belongsTo(SoilTest::class);
    }
}
