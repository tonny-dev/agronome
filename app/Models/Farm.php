<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function county()
    {
        return $this->belongsTo(County::class);
        
    }


    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
        
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
        
    }

    public function systype()
    {
        return $this->belongsTo(Systype::class);
        
    }
    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
        
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
        
    }



 

}