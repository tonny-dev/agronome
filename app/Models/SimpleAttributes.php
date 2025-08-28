<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleAttributes extends Model
{
    use HasFactory;


    public function variety()
    {
        return $this->belongsTo(Post::class);
    }


    

}
