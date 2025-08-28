<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChemicalTestParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'parameter_name', 'parameter_code', 'unit', 'optimal_min', 
        'optimal_max', 'test_method', 'description', 'is_active'
    ];

    protected $casts = [
        'optimal_min' => 'decimal:3',
        'optimal_max' => 'decimal:3',
        'is_active' => 'boolean'
    ];

    public function results()
    {
        return $this->hasMany(SoilChemicalResult::class, 'parameter_id');
    }

    public function isOptimal($value)
    {
        if (!$this->optimal_min || !$this->optimal_max) {
            return null;
        }
        
        return $value >= $this->optimal_min && $value <= $this->optimal_max;
    }

    public function getInterpretation($value)
    {
        if (!$this->optimal_min || !$this->optimal_max) {
            return 'No reference range available';
        }

        if ($value < $this->optimal_min) {
            return 'Below optimal range';
        } elseif ($value > $this->optimal_max) {
            return 'Above optimal range';
        } else {
            return 'Within optimal range';
        }
    }
}
