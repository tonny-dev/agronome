<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'recommendation_type', 'product_name', 'quantity_per_hectare',
        'unit', 'application_method', 'timing', 'estimated_cost'
    ];

    protected $casts = [
        'quantity_per_hectare' => 'decimal:2',
        'estimated_cost' => 'decimal:2'
    ];

    public function sample()
    {
        return $this->belongsTo(SoilSample::class, 'sample_id');
    }

    public function getFormattedQuantityAttribute()
    {
        return $this->quantity_per_hectare . ' ' . $this->unit . '/ha';
    }

    public function getFormattedCostAttribute()
    {
        return $this->estimated_cost ? 'KSh ' . number_format($this->estimated_cost, 2) : 'Cost not available';
    }
}
