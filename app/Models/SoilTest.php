<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoilTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'farm_id', 'vendor_id', 'kit_id', 'type', 'status',
        'pickup_at', 'testing_at', 'dropoff_at', 'allow_extra_day',
        'total_price', 'payment_status', 'payment_ref'
    ];

    protected $casts = [
        'pickup_at' => 'datetime',
        'testing_at' => 'datetime',
        'dropoff_at' => 'datetime',
        'allow_extra_day' => 'boolean',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    public function samplingPlan()
    {
        return $this->hasOne(SamplingPlan::class);
    }

    public function sampleLocations()
    {
        return $this->hasMany(SampleLocation::class)->orderBy('seq_no');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function returns()
    {
        return $this->hasOne(Returns::class);
    }

    public function resultsRawAggregate()
    {
        return $this->hasOne(ResultsRawAggregate::class);
    }

    public function canPickup()
    {
        return $this->status === 'paid' && 
               $this->payment_status === 'confirmed' && 
               now() >= $this->pickup_at;
    }

    public function transitionTo($status)
    {
        $validTransitions = [
            'draft' => ['booked'],
            'booked' => ['paid', 'cancelled'],
            'paid' => ['picked_up', 'cancelled'],
            'picked_up' => ['testing'],
            'testing' => ['awaiting_return'],
            'awaiting_return' => ['returned'],
            'returned' => ['analysis_unlocked'],
        ];

        if (!in_array($status, $validTransitions[$this->status] ?? [])) {
            throw new \InvalidArgumentException("Invalid transition from {$this->status} to {$status}");
        }

        $this->update(['status' => $status]);
    }
}
