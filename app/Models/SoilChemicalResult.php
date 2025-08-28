<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilChemicalResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'parameter_id', 'result_value', 'lab_reference',
        'test_date', 'status', 'notes'
    ];

    protected $casts = [
        'test_date' => 'datetime',
        'result_value' => 'decimal:4'
    ];

    public function sample()
    {
        return $this->belongsTo(SoilSample::class, 'sample_id');
    }

    public function parameter()
    {
        return $this->belongsTo(ChemicalTestParameter::class, 'parameter_id');
    }

    public function getFormattedValueAttribute()
    {
        return $this->result_value . ' ' . $this->parameter->unit;
    }

    public function getInterpretationAttribute()
    {
        return $this->parameter->getInterpretation($this->result_value);
    }

    public function isOptimal()
    {
        return $this->parameter->isOptimal($this->result_value);
    }
}
