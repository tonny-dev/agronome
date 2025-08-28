<?php

namespace App\Http\Livewire\Crop;

use Livewire\Component;
use App\Models\Field;
use App\Models\Crop;
use App\Models\Systype;
use App\Models\Variety;
use App\Utilities;
use App\Http\Livewire\Crop\CropServices;
use App\Models\CropsFarm;
use Debugbar;
use DebugBar\DebugBar as DebugBarDebugBar;

class LwCropAdvancedSearch extends Component
{

  public $farm_altitude;
  public $crop_id;

  public $fields = [];
  public $field;

  public $cereals_checked = 'cereals';
  public $legumes_checked = 'legumes';
  public $tubers_checked = 'roots and tubers';
  public $vegetables_checked = 'vegetables';
  public $selectedClasses = [];

  public $yield_checked = 'yielder';
  public $disease_checked = 'disease';
  public $drought_checked = 'drought';
  public $pest_checked = 'pest';
  public $selectedXtics = [];


  public $allCrops = [];
  public $filteredVarieties = [];

  public $show_details = false;

  public $crop_to_show;
  public $variety_to_show;
  public $show_advanced_search = false;
  public $show_advanced_alternatives = false;
  public $show_advanced_varieties = false;
  public $varieties;
  public $sort_descending = true;
  public $sort_yield_ascending = true;
  public $reset_varieties = 'ascending';


  public $yieldSortOrder = 'default';
  public $maturitySortOrder = 'ascending';


  public $cropYieldSortOrder = 'default';
  public $cropMaturitySortOrder = 'ascending';



  public $filter_varieties_button_text = 'filter';

  public $rankedCrops;



  public $yieldSortOrders = [

    'default' =>  'Sort By yield',
    'ascending' =>  'Max -> Min',
    'descending' => 'Min -> Max',
  ];


  // public $cropYieldSortOrders = [

  //   'default' =>    'Sort By yield',
  //   'ascending' =>  'Min -> Max',
  //   'descending' =>  'Max -> Min',
  // ];





  public $maturitySortOrders = [ ];

  protected $listeners = [
    'farm_selected_from_crop' => 'populate_fields',
    'alternatives_button_clicked' => 'show_alternatives',
    'varieties_button_clicked' => 'show_varieties',                   /*fired from LW crop card*/
    'crop_selection_updated_advancedSearch' => 'show_varieties',
    'crop_yield_button_toggled' => 'rank_crops_by_yield',    
  ];





  public function mount()
  {

    $this->selectedClasses = ['cereals','roots and tubers','legumes','vegetables'];    
    $this->selectedXtics = collect();
    $this->loadAllCrops();
  }

  public function populate_fields($farm_id)
  {

    $this->fields = Field::where('farm_id', $farm_id)->orderBy('id', 'desc')->get();
    $this->show_advanced_search = true;
  }


  public function show_alternatives(CropServices $cropService)
  {


    $this->show_advanced_alternatives = true;
    $this->show_advanced_varieties = false;
    
    $this->allCrops = Crop::orderBy('name', 'asc')->get();

    $this->allCrops   = $cropService->computeCropScore($this->allCrops, $this->get_farm_altitude());
   
    
  }



  public function rank_crops_by_yield(CropServices $cropService)
{
    $this->show_advanced_alternatives = true;
    $this->show_advanced_varieties = false;
    
    $this->allCrops = Crop::orderBy('name', 'asc')->get();

 

    // Get the sorted CropSorters collection
    $cropSortersCollection = $cropService->computeCropYieldScore($this->allCrops, $this->get_farm_altitude());

    // Create a map from crop ID to sorter index for efficient lookup
    $sorterIndex = $cropSortersCollection->mapWithKeys(function ($sorter, $index) {
        return [$sorter->id => $index];
    });

    // Sort $this->allCrops according to $cropSortersCollection order
    if ($this->cropYieldSortOrder == "ascending") {
        $this->allCrops = $this->allCrops->sortBy(function ($crop) use ($sorterIndex) {
            $sorter = $sorterIndex[$crop->id] ?? null;
            return $sorter !== null ? $sorter : PHP_INT_MAX;
        });
    } elseif ($this->cropYieldSortOrder == "descending") {
        $this->allCrops = $this->allCrops->sortByDesc(function ($crop) use ($sorterIndex) {
            $sorter = $sorterIndex[$crop->id] ?? null;
            return $sorter !== null ? $sorter : PHP_INT_MIN;
        });
    }


}



public function get_farm_altitude()
{

  // call api  () 
     return 5111;


}



  public function show_varieties($ranked_varieties,$crop_id , $farm_altitude)
  {

    $this->reset_varieties = $ranked_varieties;
    $this->selectedXtics=[];

    $this->farm_altitude = $farm_altitude;
    $this->crop_id = $crop_id;



    $this->show_advanced_varieties = true;
    $this->show_advanced_alternatives = false;
    $this->varieties = $ranked_varieties;

    $this->get_maturiry_menu();
  }



  public function get_maturiry_menu()
  {

    $menu_id = Crop::where('id',$this->crop_id)->first()->maturity_tipo;

 

    if ($menu_id == Utilities::$DEFAULT_TYPE)  { return; }

  

    else {

      $menu = Systype::where('id',$menu_id)->first()->value;

      $this->maturitySortOrders  = [ 
        'ascending' =>  strtok($menu,'|'),
        'descending' => substr($menu,strpos($menu,'|')+1)
      ];
      }

      

  }




  public function filterCrops()
  {


    $this->emit('alternatives_button_clicked');

   

    Debugbar::info('selected classes on run filter crops: ' . implode(', ', $this->selectedClasses));


    $this->allCrops = $this->allCrops->whereIn('class', $this->selectedClasses)->values();
   


   Debugbar::info('all crops: ' . $this->allCrops);



//   

      
  }


  public function loadAllCrops()
  {
  
      $this->allCrops = Crop::orderBy('name', 'desc')->get();
   
      
  }


  public function filterVarieties()
  {

    if ($this->filter_varieties_button_text == 'filter') {

      $this->varieties = null;  /* varieties filter logic  here*/
      $this->filter_varieties_button_text = 'reset';
      return;
    }

    if ($this->filter_varieties_button_text == 'reset') {

      $this->varieties = $this->reset_varieties;
      $this->filter_varieties_button_text = 'filter';
      $this->selectedXtics = [];
      return;
    }
  }



  function updatedCropYieldSortOrder()

  {

       
    $this->allCrops = Crop::orderBy('name', 'asc')->get();
   

    Debugbar::info('inside updated yield before emission ');
    $this->emit('crop_yield_button_toggled');   /* listened to in this same component */
           

  }



  function updatedyieldSortOrder()

  {

 
   $this->varieties  = Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id);


    if ($this->yieldSortOrder == 'descending') 
    {


      
    
      $this->varieties =   Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id)->sortByDesc('yield_ave')
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,2,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,3,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,4,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,5,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,6,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,7,$this->crop_id)->sortByDesc('yield_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,8,$this->crop_id)->sortByDesc('yield_ave')) ;

    } 
    

    if ($this->yieldSortOrder == 'ascending') 
    
    {
      $this->varieties = Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id)->sortBy('yield_ave')
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,2,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,3,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,4,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,5,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,6,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,7,$this->crop_id)->sortBy('yield_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,8,$this->crop_id)->sortBy('yield_ave')) ;
    }

  }



  function updatedmaturitySortOrder()

  {

    if ($this->maturitySortOrder == 'descending') 
    {

      $this->varieties =   Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id)->sortByDesc('maturity_ave')
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,2,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,3,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,4,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,5,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,6,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,7,$this->crop_id)->sortByDesc('maturity_ave')) 
                          ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,8,$this->crop_id)->sortByDesc('maturity_ave')) ;

    } 
    
    if ($this->maturitySortOrder == 'ascending') 
    
    {
      $this->varieties = Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id)->sortBy('maturity_ave')
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,2,$this->crop_id)->sortBy('maturity_ave'))  
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,3,$this->crop_id)->sortBy('maturity_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,4,$this->crop_id)->sortBy('maturity_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,5,$this->crop_id)->sortBy('maturity_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,6,$this->crop_id)->sortBy('maturity_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,7,$this->crop_id)->sortBy('maturity_ave')) 
                        ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,8,$this->crop_id)->sortBy('maturity_ave')) ;
                  }
    }



    function get_rank_by_altitude()

    {
   
                        return     Utilities::get_varieties_in_rank($this->farm_altitude,1,$this->crop_id)
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,2,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,3,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,4,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,5,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,6,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,7,$this->crop_id))
                         ->merge(Utilities::get_varieties_in_rank($this->farm_altitude,8,$this->crop_id));
  
  
  }

 

  function updatedselectedClasses()
  {
      $this->filterCrops();
  }
  

  function updatedselectedXtics()
  {


   /*return all varieties if no attribute is selected*/
    if (empty($this->selectedXtics)) { $this->varieties  = $this->get_rank_by_altitude();  return;  }
  

    $this->varieties  = Crop::getVarietyWithXtics($this->crop_id, $this->selectedXtics);

    $this->varieties  = utilities::rank_varieties($this->varieties, $this->farm_altitude);

    //



   // Utilities::rank_varieties($this->varieties,$this->farm_altitude);
    
    $this->filter_varieties_button_text = 'reset';


  }


  public function minicard_clicked($crop_name)
  {

    $this->crop_to_show = $crop_name;
  }


  public function variety_minicard_clicked($variety)
  {

    $this->variety_to_show = $variety;
    // 
  }





  public function render()
  {
    return view('livewire.crop.lw-crop-advanced-search');
  }
}