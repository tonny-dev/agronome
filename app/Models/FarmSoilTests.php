<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Farm;
use App\Models\Field;

class FarmSoilTests extends Model
{
    use HasFactory;

    protected $table = 'farm_soil_tests';
    protected $guarded = [];

    protected $casts = [
        'results' => 'array',
        'test_date' => 'datetime',
        'percent_completed' => 'integer',
    ];

    protected $dates = [
        'test_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the farmer that owns the soil test.
     */
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    /**
     * Get the farm that this soil test belongs to.
     */
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    /**
     * Get the field that this soil test belongs to.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Scope a query to only include tests for a specific farmer.
     */
    public function scopeForFarmer($query, $farmerId)
    {
        return $query->where('farmer_id', $farmerId);
    }

    /**
     * Scope a query to only include tests for a specific farm.
     */
    public function scopeForFarm($query, $farmId)
    {
        return $query->where('farm_id', $farmId);
    }

    /**
     * Scope a query to only include tests of a specific type.
     */
    public function scopeOfType($query, $testId)
    {
        return $query->where('test_id', $testId);
    }

    /**
     * Scope a query to only include completed tests.
     */
    public function scopeCompleted($query)
    {
        return $query->where('percent_completed', 100);
    }

    /**
     * Get the test type name from Systype model.
     */
    public function getTestTypeAttribute()
    {
        if (class_exists('App\Models\Systype')) {
            return \App\Models\Systype::where('id', $this->test_id)->value('value');
        }
        return 'Unknown Test Type';
    }

    /**
     * Check if the test is completed.
     */
    public function getIsCompletedAttribute()
    {
        return $this->percent_completed >= 100;
    }
}