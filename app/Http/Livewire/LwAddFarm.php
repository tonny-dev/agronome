<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use  Illuminate\Support\Facades\DB;
use App\Models\County;
use App\Models\Region;
use App\Models\Constituency;
use App\Models\Subcounty;
use App\Models\Farm;
use App\Models\Systype;
use App\Models\Ward;

class LwAddFarm extends Component
{
    public $farm_name = null;
    public $farm_id = null;
    public $farm_size = null;
    public $farmer_id = null;
    public $farms=[];
    public $current_farm = null;


    public $farming_types = [];
    public $farming_type = null;

    public $ownership_types = [];
    public $ownership_type = null;


    //ownership_types

    public $field_size = null;
    public $field_name = null;

  
    public $region = null;
    public $ward = null;
    public $county = null;
    public $subcounty = null;
    public $constituency = null;


    public $landmark = null;

    public $counties = [];
    public $subcounties = [];
    public $constituencies = [];
    public $regions = [];
    public $wards = [];

    public $success;

    public $edit_mode = false;
    public $insert_mode = false;

    protected $listeners =    
    [
    'farm_selected' => 'farm_selected', 
    'add_farm' => 'clear_fields' ,
    'save_button_clicked'=>'create_farm', 
    'farming_type_chosen' => 'set_farming_type'
     ];

    protected $rules = [
        'farm_name' => 'required',
        'county' => 'required',
        'farm_size' => 'required',
    ];


    public function mount()
    {
        $this->regions =  Region::orderBy('region')->get();
        $this->farming_types = Systype::where('tipo','farm_type')->get();
        $this->ownership_types = Systype::where('tipo','ownership')->get();
        $this->counties =  County::orderBy('county')->get();
        
      //  $this->$constituencies = Constituency::
    }


    public function clear_fields()
    {
        $this->insert_mode = true;
        $this->edit_mode = false;

        $this->farm_id = null;
        $this->region = null;
        $this->county = null;
        $this->subcounty = null;
        $this->farm_name = 'Farm#' . (User::find(Auth::user()->id)->farms()->count() + 1) . rand(0, 100);
        $this->farm_size = null;
    }



    // public function updatedRegion()
    // {
    //     $this->county = null;
    //     if (!is_null($this->region)) {
    //         $this->counties =  County::where('region_id', $this->region)->get();
    //     }     
    // }


    public function updatedCounty()
    {
          
        // $this->subcounties =  Subcounty::where('county_id', $this->county)->get();
        $this->constituencies =  Constituency::where('county_id', $this->county)->get();
        $this->wards =  Ward::where('county_id', $this->county)->get();
        $this->emit('county_selected', $this->county);   

        
    }


    public function updatedConstituency()
    {
        $this->emit('constituency_selected', $this->constituency);     
        $this->wards =  Ward::where('subcounty_id', $this->constituency)->get();
        // $this->subcounties =  Subcounty::where('county_id', $this->county)->get();
        // $this->constituencies =  Constituency::where('county_id', $this->county)->get();
       
        // $this->emit('county_selected', $this->county);   

    }



    public function updatedSubcounty()
    {
        $this->wards =  Ward::where('subcounty_id', $this->subcounty)->get();
    }


    public function updatedWard()
    {
//        $this->wards =  Ward::where('subcounty_id', $this->subcounty)->get();

        $this->emit('ward_selected', $this->county,$this->constituency
        ,$this->ward);   
    }

    

    public function addField()
    {


        
    }

 


    public function store()
    {
      //  ($this->farm_id) ? $this->update($this->farm_id) : $this->create();
    }



  


    public function update($farm_id)
    {
        DB::table('farms')
            ->where('id', $farm_id)
            ->update([
                'name' => $this->farm_name,
                'farm_size' => $this->farm_size,
                'region_id' => $this->region,
                'county_id' => $this->county,
                'subcounty_id' => $this->subcounty,               
                'updated_by' => Auth::user()->id
            ]);

        // $this->success = 'Action completed successfully';

        // return redirect('/farmer_dashboard');
    }



    public function create_farm($geojson , $lat , $long)
    {

       //$validated = $this->validate();      

        Farm::create(
            [
                'farmer_id' => Auth::user()->id,
                'name' => $this->farm_name,
                'farm_size' => $this->farm_size,
                'region_id' => $this->region,
                'county_id' => $this->county,
                'subcounty_id' => $this->constituency,  /*in practice the constituency and the subcounty are the same*/
                'constituency_id' => $this->constituency,
                'ward_id' => $this->ward,
                'notes' => $this->landmark,
                'farming_type_id' => $this->farming_type,
                'geo_json' => $geojson,
                'lat' => $lat,
                'long' => $long,
                'updated_by' =>  Auth::user()->id
            ]
        );


        $farm_id =Farm::where('farmer_id',  Auth::user()->id)->max('id');

        $this->emit('farm_created', $farm_id);

    }



    public function set_farming_type($farming_type)
    {

        $this->farming_type = $farming_type;
    }



    public function farm_selected($farm_id)
    {
        $this->edit_mode = true;
        $this->farm_id = $farm_id;

        // $this->regions =  Region::orderBy('region')->get();
        $this->counties =  County::where('region_id', $this->region)->get();
        $this->subcounties =  Subcounty::where('county_id', $this->county)->get();
        $this->region = Farm::where('id', $this->farm_id)->first()->region_id;
        $this->county = Farm::where('id', $this->farm_id)->first()->county_id;
        $this->subcounty = Farm::where('id', $this->farm_id)->first()->subcounty_id;


        $this->farm_name = Farm::where('id', $this->farm_id)->first()->name;
        $this->farm_size = Farm::where('id', $this->farm_id)->first()->farm_size;
    }


    public function render()
    {
        if ($this->farm_id) {
            //  dd(null);
            // $this->regions =  Region::orderBy('region')->get();
            $this->counties =  County::where('region_id', $this->region)->get();
            $this->subcounties =  Subcounty::where('county_id', $this->county)->get();


            // $this->region = Farm::where('id', $this->farm_id)->first()->region_id;
            $this->county = Farm::where('id', $this->farm_id)->first()->county_id;
            $this->subcounty = Farm::where('id', $this->farm_id)->first()->subcounty_id;


            //  $myField = Model::where('name', 'John Doe')->first()->my_field;
        }

        return view('livewire.lw-add-farm');
    }
}