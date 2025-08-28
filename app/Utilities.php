<?php

namespace App;

use App\Models\Variety;
//use DebugBar;
use Barryvdh\Debugbar\Facades\Debugbar;



class Utilities


{

    public static  $zone = [];
    public $altitude;
    public static $sorted_array = null;

    public static  $DEFAULT_TYPE = 1025; 



 

 
    public static function set_zone($altitude)

    {


        $coastal = ['low' => '0', 'high' => '900'];
        $coastal_trans = ['low' => '900', 'high' => '1200'];
        $mid = ['low' => '1200', 'high' => '1600'];
        $mid_trans = ['low' => '1600', 'high' => '1800'];
        $highland = ['low' => '1800', 'high' => '5200'];


        if ($altitude <= 900) {
            static::$zone = $coastal;;
        }
        if ($altitude >= 900 && $altitude <= 1200) {
            static::$zone = $coastal_trans;;
        }
        if ($altitude >= 1200 && $altitude <= 1600) {
            static::$zone = $mid;;
        }
        if ($altitude >= 1600 && $altitude <= 1800) {
            static::$zone = $mid_trans;;
        }
        if ($altitude >= 1800 && $altitude <= 5200) {
            static::$zone = $highland;;
        }
    }



/*
Skeleton for function that will rerank filtered 
varieties

takes in varieties amd farm altitiude 

*/

	public static function rank_varieties($varieties ,$farm_altitude)

	{

        self::set_zone($farm_altitude);

        Debugbar::info($farm_altitude);


        return      $varieties->where('alt_min', '>=', static::$zone['low'])->where('alt_max', '<=', static::$zone['high'])->merge  // r1
           ($varieties->where('alt_min', '<=',  static::$zone['low'])->where('alt_max', '>=', static::$zone['high']))->merge  // r2
           ($varieties->where('alt_min', '=',   static::$zone['low'])->where('alt_max', '>', static::$zone['high']))->merge  // r3
           ($varieties->where('alt_min', '<',   static::$zone['low'])->where('alt_max', '=', static::$zone['high']))->merge  // r4
           ($varieties->where('alt_min', '<',   static::$zone['low'])->where('alt_max', '<', static::$zone['high'])->where('alt_max', '>=', static::$zone['low']))->merge  // r5
          ($varieties->where('alt_min', '>',   static::$zone['low'])->where('alt_max', '<=', static::$zone['high'])->where('alt_max', '>', static::$zone['high']))->merge  // r6
           ($varieties->where('alt_min', '<',   static::$zone['low']))->merge  // r7
          ($varieties->where('alt_min', '>',   static::$zone['high']));  //r8  

           
        

	//return null;

	}



    public static function get_varieties_in_rank($altitude, $rank, $crop_id)

    {

        // list crops that are within range R1

        self::set_zone($altitude);


        if ($rank == 1) {

            // list crops that are within range R1 - within range
            return   Variety::where('crop_id', $crop_id)
                ->where('alt_min', '>=', static::$zone['low'])
                ->where('alt_max', '<=', static::$zone['high'])
                ->get();
        }


        if ($rank == 2) {

            // list crops that are within range R2 - without range 
            return  Variety::where('crop_id', $crop_id)
                ->where('alt_min', '<=', static::$zone['low'])
                ->where('alt_max', '>=', static::$zone['high'])
                ->get();
        }

        if ($rank == 3) {

            // list crops that are within range R3
            return   Variety::where('crop_id', $crop_id)
                ->where('alt_min', '=', self::$zone['low'])
                ->where('alt_max', '>', self::$zone['high'])
                ->get();
        }


        if ($rank == 4) {
            // list crops that are within range R4
            return   Variety::where('crop_id', $crop_id)
                ->where('alt_min', '<', self::$zone['low'])
                ->where('alt_max', '=', static::$zone['high'])
                ->get();
        }

        if ($rank == 5) {
            // list crops that are within range R5
            return  Variety::where('crop_id', $crop_id)
                ->where('alt_min', '<', static::$zone['low'])
                ->where('alt_max', '<', static::$zone['high'])
                ->where('alt_max', '>=', static::$zone['low'])
                ->get();
        }

        if ($rank == 6) {
            // list crops that are within range R6
            return  Variety::where('crop_id', $crop_id)
                ->where('alt_min', '>', static::$zone['low'])
                ->where('alt_min', '<=', static::$zone['high'])
                ->where('alt_max', '>', static::$zone['high'])
                ->get();
        }

        if ($rank == 7) {

            // list crops that are within range R7
            return    Variety::where('crop_id', $crop_id)
                ->where('alt_max', '<', static::$zone['low'])
                ->get();
        }


        if ($rank == 8) {

            // list crops that are within range R8
            return    Variety::where('crop_id', $crop_id)
                ->where('alt_min', '>', static::$zone['high'])
                ->get();
        }




        // $this->varieties_ranked_by_altitude =       $this->varieties_r1
        //     ->merge($this->varieties_r2)
        //     ->merge($this->varieties_r3)
        //     ->merge($this->varieties_r4)
        //     ->merge($this->varieties_r5)
        //     ->merge($this->varieties_r6)
        //     ->merge($this->varieties_r7)
        //     ->merge($this->varieties_r8);
    }


    public static function  sort_array_by_key($array, $sort_key, $order)

    {


        if (!$array) {    return;    }

        if ($order == 'ascending') {

          array_multisort(array_column($array, $sort_key), SORT_ASC, $array);
          return $array; 

    }

        else{

            array_multisort(array_column($array, $sort_key), SORT_DESC, $array);
            return $array;
        }
}


}
