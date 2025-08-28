<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilHealthScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'overall_score', 'ph_score', 'nutrient_score',
        'organic_matter_score', 'interpretation'
    ];

    protected $casts = [
        'overall_score' => 'decimal:2',
        'ph_score' => 'decimal:2',
        'nutrient_score' => 'decimal:2',
        'organic_matter_score' => 'decimal:2'
    ];

    public function sample()
    {
        return $this->belongsTo(SoilSample::class, 'sample_id');
    }

    public function getHealthGradeAttribute()
    {
        return match(true) {
            $this->overall_score >= 80 => 'Excellent',
            $this->overall_score >= 60 => 'Good',
            $this->overall_score >= 40 => 'Fair',
            $this->overall_score >= 20 => 'Poor',
            default => 'Very Poor'
        };
    }

    public function getScoreColorAttribute()
    {
        return match(true) {
            $this->overall_score >= 80 => 'success',
            $this->overall_score >= 60 => 'info',
            $this->overall_score >= 40 => 'warning',
            default => 'danger'
        };
    }
}
