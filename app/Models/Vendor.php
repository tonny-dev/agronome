<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'location_admin_code', 'location_name', 'lat', 'lng', 'contact'
    ];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
    ];

    public function kits()
    {
        return $this->hasMany(Kit::class);
    }

    public function availableKits()
    {
        return $this->kits()->where('status', 'available');
    }

    public function soilTests()
    {
        return $this->hasMany(SoilTest::class);
    }
}
