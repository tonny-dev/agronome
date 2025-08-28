<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantHistory extends Model
{
    use HasFactory;


    protected $table=  'plant_history';  
    protected $guarded = [];   
}
