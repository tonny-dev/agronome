<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Models\SimpleAttributes;
use App\Models\Variety;

class Crop extends Model
{
    use HasFactory;



    public function varieties()
    {
        return $this->hasMany('App\Models\Variety');
    }



    public static function get_pests($id)
    {
        return DB::table('crops_pests')
        ->join('crops', 'crops.id', '=', 'crops_pests.crop_id')
        ->join('pests', 'pests.id', '=', 'crops_pests.pest_id')
        ->select('pests.name')
        ->where('crops.id', '=', $id)
        ->get();    

    }

    public function get_diseases($id)
    {
        return DB::table('crops_diseases')
        ->join('crops', 'crops.id', '=', 'crops_diseases.crop_id')
        ->join('diseases', 'diseases.id', '=', 'crops_diseases.disease_id')
        ->select('diseases.name')
        ->where('crops.id', '=',$id)
        ->get();    

    }




    public function get_attributes($id)
    {
        return DB::table('varieties_attributes')
        ->join('crops', 'crops.id', '=', 'varieties_attributes.crop_id')
        ->join('attributes', 'attributes.id', '=', 'varieties_attributes.attribute_id')
        ->select('attributes.id', 'attributes.attribute')
        ->where('crops.id', '=',$id)
        ->distinct()
        ->get();    
    }


    public function get_varieties($id)
    {
        return DB::table('varieties')
        ->select('id','name','blurb')
        ->where('crop_id', '=',$id)
        ->distinct()
        ->get();    

    }

    public function get_varieties_with_attribute($crop_id,$attribute_id)
    {

        // select  a."attribute"  , v."name" 
        // from 
        // varieties_attributes va 
        // join varieties v  on v.id = va.variety_id 
        // join attributes a on a.id = va.attribute_id 
        // where va.crop_id  = 1 
        // and va.attribute_id  = 1



        return DB::table('varieties_attributes')
        ->join('varieties', 'varieties.id', '=', 'varieties_attributes.variety_id')
        ->join('attributes', 'attributes.id', '=', 'varieties_attributes.attribute_id')
        ->select('varieties.id','varieties.name','varieties.blurb')
        ->where('varieties_attributes.attribute_id', '=',$attribute_id)
        ->where('varieties_attributes.crop_id', '=',$crop_id)
        ->distinct()
        ->get();    

    }

    public static function getVarietyWithXtics( int $crop_id, array $xtics)
    {


        // foreach($xtics as $x => $x_value)  {

        //    // Debugbar::info(SimpleAttributes::where('xtic',$x_value)->pluck('variety_id'));
         
        //     if  (SimpleAttributes::where('xtic',$x_value)->pluck('variety_id')->isEmpty()) 
        //     {               
            
        //            return [];
        //     }
           
        //   }


       $ids  = SimpleAttributes::where('crop_id',$crop_id)->whereIn('xtic',$xtics)->pluck('variety_id');
       return Variety::whereIn('id',$ids)->get();


    }


}


