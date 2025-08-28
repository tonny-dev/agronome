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
use Barryvdh\Debugbar\Facades\Debugbar;
use App\CustomClasses\CropSorter;

class CropServices extends Component
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
    public $alt_clicked_class ='bg-red-300';
    public $alternatives_clicked =false;
    public $varieties_clicked =false;
    public $varieties_ranked_by_altitude =false;

    public $zone;



    public  function computeCropYieldScore($crops , $altitude)
    {


        $this->set_zone($altitude);

        $cropSortersCollection = collect();
    
      

        foreach ($crops as $crop) {

         

           $cropSorter =
            new CropSorter
              ($this->percentage_to_r4($crop),
              $this->percentage_to_r6($crop),
              $this->compute_average($crop),
              $crop->id,
              $crop->name);

           $cropSortersCollection->push($cropSorter);

            Debugbar::info(' =========================================== ');
            Debugbar::info('crop '. $crop->name);

            Debugbar::info('altitude '.$altitude);


             Debugbar::info(' % to R4 ' .      $cropSorter->getPercentage());        
             Debugbar::info(' cumulative to R6 % ' . $cropSorter->getCumulative());

             Debugbar::info('Average yield ' . $this->compute_average($crop));     
             
                         


        }  


        $sortedCollection = $cropSortersCollection->sort(function ($a, $b) {
          // Compare by percentage in descending order
              $percentageComparison = $b->getPercentage() <=> $a->getPercentage();
                
                    if ($percentageComparison === 0) {
                        // If percentages are the same, compare by cumulative
                             $cumulativeComparison = $b->getCumulative() <=> $a->getCumulative();
                
                        if ($cumulativeComparison === 0) {
                            // If cumulatives are the same, compare by average
                                   return $b->getAverage() <=> $a->getAverage();
                        }
                
                        return $cumulativeComparison;
                    }
                
          return $percentageComparison;
      })->values();
      
      
      
      
      return $sortedCollection;



    }


    public function compute_average($crop) 
    {

      $varieties =     Variety::where('crop_id', $crop->id)->get();
      
      if ($varieties->isEmpty()) {
          return 0;

      }

      // Calculate the average yield
      $totalYield = $varieties->sum('yield_ave');
      $averageYield = round(($totalYield / $varieties->count())*411.1795,2);

      

      return $averageYield;

    }



    public function percentage_to_r4($crop)
    {

        


        $varieties_r1 =     Variety::where('crop_id', $crop->id)
        ->where('alt_min','>=',$this->zone['low'])
        ->where('alt_max','<=',$this->zone['high'])
        ->get() ;


        if ( $varieties_r1 == null )
           {return 0;}
           else 
           {
            
             $percentage_r1 =   round  (  (($varieties_r1->count()/$crop->varieties->count() )/1)*100, 1 );
         
         
          } 



          $varieties_r2 =     Variety::where('crop_id', $crop->id)
          ->where('alt_min','<',$this->zone['low'])
          ->where('alt_max','>',$this->zone['high'])
          ->get() ;
   
          if ( $varieties_r2 == null )
          {return 0;}
          else 
          {
           
            $percentage_r2 =   round  (  (($varieties_r2->count()/$crop->varieties->count() )/1)*100, 1 );
        
        
         }


        
       
       $varieties_r3 =     Variety::where('crop_id', $crop->id)
      ->where('alt_min','=',$this->zone['low'])
      ->where('alt_max','>',$this->zone['high'])
      ->get() ;


        if ( $varieties_r3 == null )
        {return 0;}
        else 
        {
         
          $percentage_r3 =   round  (  (($varieties_r3->count()/$crop->varieties->count() )/1)*100, 1 );
      
      
      }



      
      $varieties_r4 =    Variety::where('crop_id', $crop->id)
      ->where('alt_min','<',$this->zone['low'])
      ->where('alt_max','=',$this->zone['high'])
      ->get() ;

      if ( $varieties_r4 == null )
      {return 0;}
      else 
      {
       
        $percentage_r4 =   round  (  (($varieties_r4->count()/$crop->varieties->count() )/1)*100, 1 );
    
    
    }




     return $percentage_r1 + $percentage_r2 + $percentage_r3 + $percentage_r4;



    }



    public function percentage_to_r6($crop)
    {

        


        $varieties_r5 =     Variety::where('crop_id', $crop->id)
        ->where('alt_min','<',$this->zone['low'])
        ->where('alt_max','<',$this->zone['high'])
        ->where('alt_max','>=',$this->zone['low'])
        ->get() ;


        if ( $varieties_r5 == null )
           {return 0;}
           else 
           {
            
             $percentage_r5 =   round  (  (($varieties_r5->count()/$crop->varieties->count() )/1)*100, 1 );
         
         
          } 



          $varieties_r6 =      Variety::where('crop_id', $crop->id)
          ->where('alt_min','>',$this->zone['low'])
          ->where('alt_min','<=',$this->zone['high'])
          ->where('alt_max','>',$this->zone['high'])
          ->get() ;
   
          if ( $varieties_r6 == null )
          {return 0;}
          else 
          {
           
            $percentage_r6 =   round  (  (($varieties_r6->count()/$crop->varieties->count() )/1)*100, 1 );
        
        
          } 


        

            return $percentage_r5 + $percentage_r6 + $this->percentage_to_r4($crop) ;



    }



 



    public  function computeCropScore($crops , $altitude)
    {


        $this->set_zone($altitude);

        $crop_score_map = [];
    

        foreach ($crops as $crop) {

         //   echo $crop->name;

            Debugbar::info('crop '. $crop->name);
            Debugbar::info('varieties '.$crop->varieties->count());

            Debugbar::info('altitude '.$altitude);

            Debugbar::info('zone high '.$this->zone['high']);
            Debugbar::info('zone low '.$this->zone['low']);

            Debugbar::info('rank 1 score '. $this->rank_one_variety_count($crop));
            Debugbar::info('rank 2 score '. $this->rank_two_variety_count($crop));
            Debugbar::info('rank 3 score '. $this->rank_three_variety_count($crop));
            Debugbar::info('rank 4 score '. $this->rank_four_variety_count($crop));
            Debugbar::info('rank 5 score '. $this->rank_five_variety_count($crop));
            Debugbar::info('rank 6 score '. $this->rank_six_variety_count($crop));
            Debugbar::info('rank 7 score '. $this->rank_seven_variety_count($crop));
            Debugbar::info('rank 8 score '. $this->rank_eight_variety_count($crop));

            $crop_score = $this->rank_one_variety_count($crop) + 
                          $this->rank_two_variety_count($crop) +
                          $this->rank_three_variety_count($crop) +
                          $this->rank_four_variety_count($crop) +
                          $this->rank_five_variety_count($crop) + 
                          $this->rank_six_variety_count($crop) + 
                          $this->rank_seven_variety_count($crop) +
                          $this->rank_eight_variety_count($crop);

            Debugbar::info('crop score '. $crop_score);



            $crop_score_map[$crop->id] = $crop_score;

            Debugbar::info($crop_score_map);


        }

        Debugbar::info('=============== sorted map here   ==');


        asort($crop_score_map);

        Debugbar::info($crop_score_map);

        $ranked_alternatives = [];

        foreach ($crop_score_map as $crop_id => $crop_score)
         {
          $crop = Crop::find($crop_id); 
          $ranked_alternatives[] = $crop;
        }

        Debugbar::info('===== ranked alternattives here   ======');
        Debugbar::info($crop_score_map);


           return  $ranked_alternatives;

    }
 



    public function rank_one_variety_count ($crop)

    {            
      

                
        $varieties =     Variety::where('crop_id', $crop->id)
           ->where('alt_min','>=',$this->zone['low'])
           ->where('alt_max','<=',$this->zone['high'])
           ->get() ;


           if ( $varieties == null )
              {return 0;}
              else 
              {
               
                return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*1, 2 );
            
            
            }
       

   }




   public function rank_two_variety_count($crop)

   {            
      
                     
       $varieties =     Variety::where('crop_id', $crop->id)
       ->where('alt_min','<',$this->zone['low'])
       ->where('alt_max','>',$this->zone['high'])
       ->get() ;

       if ( $varieties == null )
       {return 0;}
       else 
       {
        
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*2, 2 );
     
     
     }
      

  }


  public function rank_three_variety_count ($crop)

  {                          
              
      $varieties =     Variety::where('crop_id', $crop->id)
      ->where('alt_min','=',$this->zone['low'])
      ->where('alt_max','>',$this->zone['high'])
      ->get() ;


      if ( $varieties == null )
              {return 0;}
              else 
              {
               
                return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*3, 2 );
            
            
            }
     

 }


 public function rank_four_variety_count ($crop)

 {                          
             
     $varieties =     Variety::where('crop_id', $crop->id)
     ->where('alt_min','<',$this->zone['low'])
     ->where('alt_max','=',$this->zone['high'])
     ->get() ;


     if ( $varieties == null )
     {return 0;}
     else 
     {
      
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*4, 2 );
   
   
   }
    

}

public function rank_five_variety_count ($crop)

 {                          
             
     $varieties =     Variety::where('crop_id', $crop->id)
     ->where('alt_min','<',$this->zone['low'])
     ->where('alt_max','<',$this->zone['high'])
     ->where('alt_max','>=',$this->zone['low'])
     ->get() ;


     if ( $varieties == null )
     {return 0;}
     else 
     {
      
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*5, 2 );
   
   
   }
    

}


public function rank_six_variety_count ($crop)

 {                          
             
     $varieties =     Variety::where('crop_id', $crop->id)
     ->where('alt_min','>',$this->zone['low'])
     ->where('alt_min','<=',$this->zone['high'])
     ->where('alt_max','>',$this->zone['high'])
     ->get() ;


     if ( $varieties == null )
     {return 0;}
     else 
     {
      
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*6, 2 );
   
   
   }
    

}


public function rank_seven_variety_count ($crop)

 {                          
             
     $varieties =     Variety::where('crop_id', $crop->id)
     ->where('alt_max','<',$this->zone['low'])
     ->get() ;


     if ( $varieties == null )
     {return 0;}
     else 
     {
      
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*7, 2 );
   
   
   }
    

}

public function rank_eight_variety_count ($crop)

 {                          
             
     $varieties =     Variety::where('crop_id', $crop->id)
     ->where('alt_min','>',$this->zone['high'])
     ->where('alt_max','>',$this->zone['high'])
     ->get() ;


     if ( $varieties == null )
     {return 0;}
     else 
     {
      
        return  round  (  (($varieties->count()/$crop->varieties->count() )/1)*8, 2 );
   
   
   }
    

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




}