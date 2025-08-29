<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vendor_id', 'status', 'serial_no', 'last_diagnostics_at'
    ];

    protected $casts = [
        'last_diagnostics_at' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function inventoryLedgers()
    {
        return $this->hasMany(InventoryLedger::class);
    }

    public function soilTests()
    {
        return $this->hasMany(SoilTest::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }

    public function hold($refType, $refId, $metadata = [])
    {
        $this->update(['status' => 'held']);
        $this->inventoryLedgers()->create([
            'event' => 'hold',
            'ref_type' => $refType,
            'ref_id' => $refId,
            'metadata' => $metadata
        ]);
    }
}
