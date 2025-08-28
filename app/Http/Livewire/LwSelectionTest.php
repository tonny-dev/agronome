<?php

namespace App\Http\Livewire;

use App\Models\Crop;
use App\Models\Variety;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;






class LwSelectionTest extends Component

{

public $crop;
public $crops = [];

public $variety;
public $varieties = [];


public $varieties_r1 = [];
public $varieties_r2 = [];
public $varieties_r3 = [];
public $varieties_r4 = [];
public $varieties_r5 = [];
public $varieties_r6 = [];
public $varieties_r7 = [];
public $varieties_r8 = [];

public $altitude = null;
public $long = null;
public $lat = null;
public $zone = null;    

protected $listeners = ['xy_chosen'=>'get_elevation'];


    public function mount()
    {

        $this->crops = Crop::all();
    }


    public function get_elevation($lat , $long)
    {

        $this->long = $long;
        $this->lat = $lat;
        $url = 'https://api.open-elevation.com/api/v1/lookup?locations='. $lat.','.$long;
        $client = new Client();
        $response = $client->request('GET',$url, ['verify' => false]);
        $elevation =   json_decode($response->getBody());      
        $this->altitude =   $elevation->results[0]->elevation;; 

    }



    public function updatedCrop()


    {


       $this->compute_rank();             
                     
    

    }


    public function get_zone($altitude)

    {
    
            
    $coastal = ['low'=>'0','high'=>'900'];
    $coastal_trans = ['low'=>'900','high'=>'1200'];
    $mid = ['low'=>'1200','high'=>'1600'];
    $mid_trans = ['low'=>'1600','high'=>'1800'];
    $highland = ['low'=>'1800','high'=>'5200'];


    if     ($altitude<=900) {   $this->zone = $coastal; ;}
    if     ($altitude>=900 && $altitude<=1200)  {   $this->zone = $coastal_trans; ;}
    if     ($altitude>=1200 && $altitude<=1600) {   $this->zone = $mid; ;}
    if     ($altitude>=1600 && $altitude<=1800) {   $this->zone = $mid_trans; ;}
    if     ($altitude>=1800 && $altitude<=5200) {   $this->zone = $highland; ;}
   

    }




    public function compute_rank ()

     {         
                  
          // list crops that are within range R1
        
            $this->get_zone($this->altitude);

          // list crops that are within range R1
            $this->varieties_r1 =  Variety::where('crop_id', $this->crop)
            ->where('alt_min','>=',$this->zone['low'])
            ->where('alt_max','<=',$this->zone['high'])
            ->get() ;

          // list crops that are within range R2
          $this->varieties_r2 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','<=',$this->zone['low'])
          ->where('alt_max','>=',$this->zone['high'])
          ->get() ;

          // list crops that are within range R3
          $this->varieties_r3 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','=',$this->zone['low'])
          ->where('alt_max','>',$this->zone['high'])
          ->get() ;

          // list crops that are within range R4
          $this->varieties_r4 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','<',$this->zone['low'])
          ->where('alt_max','=',$this->zone['high'])
          ->get() ;

          // list crops that are within range R5
          $this->varieties_r5 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','<',$this->zone['low'])
          ->where('alt_max','<',$this->zone['high'])
          ->where('alt_max','>=',$this->zone['low'])
          ->get(); 

          // list crops that are within range R6
          $this->varieties_r6 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','>',$this->zone['low'])
          ->where('alt_min','<=',$this->zone['high'])
          ->where('alt_max','>',$this->zone['high'])
          ->get(); 

            // list crops that are within range R7
          $this->varieties_r7 =  Variety::where('crop_id', $this->crop)
          ->where('alt_max','<',$this->zone['low'])
          ->get(); 
                   
          // list crops that are within range R5
          $this->varieties_r8 =  Variety::where('crop_id', $this->crop)
          ->where('alt_min','>',$this->zone['high'])
          ->get(); 
          


    }


        public function get_varieties ()

    {         
                 
                     $varieties =  Variety::where('crop_id', $this->crop)
                     ->where('alt_min','>=',$this->zone['low'])
                     ->where('alt_max','<=',$this->zone['high'])
                     ->get() ;

                     return $varieties;

   }






    public function render()
    {
        return view('livewire.lw-selection-test');
    }



}