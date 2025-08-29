<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLedger extends Model
{
    protected $fillable = [
        'kit_id', 'event', 'ref_type', 'ref_id', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }
}
