<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id', 'field_id', 'user_id', 'sample_code', 'collection_date',
        'latitude', 'longitude', 'depth_cm', 'weather_conditions', 'notes', 'status'
    ];

    protected $casts = [
        'collection_date' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chemicalResults()
    {
        return $this->hasMany(SoilChemicalResult::class, 'sample_id');
    }

    public function recommendations()
    {
        return $this->hasMany(SoilRecommendation::class, 'sample_id');
    }

    public function healthScore()
    {
        return $this->hasOne(SoilHealthScore::class, 'sample_id');
    }

    public function generateSampleCode()
    {
        return 'SS-' . $this->farm_id . '-' . date('Ymd') . '-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'collected' => 'warning',
            'sent_to_lab' => 'info',
            'results_received' => 'success',
            default => 'secondary'
        };
    }
}
