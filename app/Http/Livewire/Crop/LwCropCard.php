<?php

namespace App\Http\Livewire\Crop;

use App\Models\Constituency;
use App\Models\County;
use Livewire\Component;
use App\Models\Farm;
use App\Models\Variety;
use App\Models\Crop;
use Illuminate\Support\Facades\Auth;
use  App\Utilities;

class LwCropCard extends Component
{

    public $farms=[];
    public $farm;

    public $fields = [];
    public $field;

    public $county;
    public $constituency;

    public $crops=[];
    public $crop=null;

    public $secondary_crops=[];
    public $secondary_crop;

    public $varieties=[];
    public $variety;

    public $crop_name;
    public $alternative_name;
    public $class_blurb;
    public $altitude;
    public $farm_altitude;
    public $alt_clicked_class ='bg-red-300';
    public $alternatives_clicked =false;
    public $varieties_clicked =false;
    public $varieties_ranked_by_altitude =false;

    public $zone;





    public function mount()
    {

     $this->farms = Farm::where('farmer_id',Auth::user()->id) ->orderBy('id','desc')->get();
     $this->crops = Crop::all();
     $this->secondary_crops = Crop::all();

    }
 

    public function updatedCrop()
    {

     if (!$this->crop) {return;} 

       $this->varieties = Variety::where('crop_id', $this->crop)->orderBy('name','desc')->get();

       $this->farm_altitude = 5111; /* get from API use this for now */

       $this->crop_name = Crop::where('id', $this->crop)->first()->name;
       $this->alternative_name = Crop::where('id', $this->crop)->first()->alt_name;
       $this->class_blurb = Crop::where('id', $this->crop)->first()->classificationblurb;

      

       $this->emit('crop_selection_updated',$this->farm_altitude);     /*farm_altitude,*/  

     //  $this->emit('crop_selection_updated_advancedSearch',$this->varieties); 

       foreach ($this->varieties as $variety)
        {
            $this->draw_variety($variety);
        }


    }



    public function draw_variety($variety)
    {

        $color = $this->compute_rank_color($variety);
       
        $this->emit('variety_loaded', $variety->name,$variety->alt_min,$variety->alt_max,$color);

    }



    public function set_zone($altitude)

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



    public function compute_rank_color ($variety)

    {   

          

        $this->set_zone($this->farm_altitude);  


      
        if (($variety->alt_min<$this->zone['low']) && ($variety->alt_max<$this->zone['high'])   && ($variety->alt_max>=$this->zone['low'])  ) 
        {
             return 'darkorange';
        }

        if (($variety->alt_min>=$this->zone['low']) && ($variety->alt_max<=$this->zone['high']))  // list crops that are within range R1 - within range
 
        {
            
             return 'green';
        }

        if (($variety->alt_min<=$this->zone['low']) && ($variety->alt_max>=$this->zone['high'])) // list crops that are within range R2 - without range

        {
             return 'green';
        }

        if (($variety->alt_min=$this->zone['low']) && ($variety->alt_max>$this->zone['high'])) 
        {
             return 'darkorange';
        }


        if (($variety->alt_min<$this->zone['low']) && ($variety->alt_max=$this->zone['high'])) 
        {
             return 'darkorange';
        }
  

        if (($variety->alt_min>$this->zone['low']) && ($variety->alt_max<=$this->zone['high'])   && ($variety->alt_max>$this->zone['high'])  ) 
        {
             return 'darkorange';
        }


        if (($variety->alt_max<$this->zone['low']) ) 
        {
             return 'red';
        }

        if (($variety->alt_min>$this->zone['high']) ) 
        {
             return 'red';
        }
     

       return 'red';


    }


    public function compute_rank ()

    {         
                 
         // list crops that are within range R1
       
           $this->set_zone($this->farm_altitude);

         
         // list crops that are within range R1 - within range
           $this->varieties_r1 =  Variety::where('crop_id', $this->crop)
           ->where('alt_min','>=',$this->zone['low'])
           ->where('alt_max','<=',$this->zone['high'])
           ->get() ;

         // list crops that are within range R2 - without range 
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
                  
         // list crops that are within range R8
         $this->varieties_r8 =  Variety::where('crop_id', $this->crop)
         ->where('alt_min','>',$this->zone['high'])
         ->get(); 
         

         $this->varieties_ranked_by_altitude =       $this->varieties_r1
                                                ->merge($this->varieties_r2)
                                                ->merge($this->varieties_r3)
                                                ->merge($this->varieties_r4)
                                                ->merge($this->varieties_r5)
                                                ->merge($this->varieties_r6)
                                                ->merge($this->varieties_r7)
                                                ->merge($this->varieties_r8);


   }

    public function updatedfarm()
    {

        $constituency_id  = Farm::where('id', $this->farm)->first()->constituency_id; 
        $county_id  = Farm::where('id', $this->farm)->first()->county_id; 
        $this->county = County::where('id', $county_id)->first()->county;
        $this->constituency = Constituency::where('id', $constituency_id)->first()->constituency;

        // emits to advanced search because 
        $this->emit('farm_selected_from_crop', $this->farm);

    }

    public function alternatives_clicked()
    {

        $this->alternatives_clicked = true;
        $this->varieties_clicked = false;
        // emits to advanced search

        $this->emit('alternatives_button_clicked');

    }

    public function varieties_clicked()
    {
        $this->compute_rank();

        $this->varieties_clicked = true;
        $this->alternatives_clicked = false;
        
        $this->emit('varieties_button_clicked',$this->varieties_ranked_by_altitude,$this->crop , $this->farm_altitude);

    }


    public function render()
    {
        return view('livewire.crop.lw-crop-card');
    }


}