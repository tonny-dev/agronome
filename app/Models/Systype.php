<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systype extends Model
{
    use HasFactory;
    protected $table = "tipos";
    protected $guarded = [];
    


    public static function getTipo($id)
{
    
    return Systype::where('id',$id)->first()->value;

}




}
