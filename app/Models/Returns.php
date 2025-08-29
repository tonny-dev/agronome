<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = [
        'soil_test_id', 'vendor_checked', 'vendor_notes', 
        'diagnostics_result', 'user_confirmed', 'confirmed_at'
    ];

    protected $casts = [
        'vendor_checked' => 'boolean',
        'user_confirmed' => 'boolean',
        'confirmed_at' => 'datetime',
    ];

    public function soilTest()
    {
        return $this->belongsTo(SoilTest::class);
    }

    public function canUnlockAnalysis()
    {
        return $this->diagnostics_result === 'pass' && $this->user_confirmed;
    }
}
