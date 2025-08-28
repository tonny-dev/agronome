<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Landmark;
use App\Models\Subcounty;
use App\Models\County;
use App\Models\Ward;

class Landmarksearch extends Component
{
    public $subcounty = null;
    public $constituency = null;


    public $school = null;
    public $hospital = null;
    public $market = null;

    public $counties = [];
    public $schools = [];
    public $hospitals = [];
    public $markets = [];

    public $county_name;
    public $subcounty_name;
    public $ward_name;

    public $subcounties = [];

    protected $listeners = [
                            'county_selected' => 'filter_subcounties' ,
                            'constituency_selected' => 'filter_landmarks',
                            'ward_selected' => 'write_location_scope',
                        ];
    
    
    
    public function mount()
    {
        // $this->subcounties =  Subcounty::orderBy('subcounty')->get();
        // $this->farming_types = Systype::where('tipo','farm_type')->get();
        // $this->landmarks =  Landmark::orderBy('landmark')->get();
      //  $this->$constituencies = Constituency::
    }

    
    
    public function filter_subcounties($county_id)
   
    {
        $this->subcounties =  Subcounty::where('county_id', $county_id)->get();

        $this->markets=  Landmark::where('county_id', $county_id)
        ->where('tipo', 'market')
        ->get();
    }
    
    
    public function filter_landmarks($constituency_id)
   
    {
        $this->schools=  Landmark::where('const_id', $constituency_id)
        ->where('tipo', 'school')
        ->get();


        $this->hospitals=  Landmark::where('const_id', $constituency_id)
        ->where('tipo', 'hospital')
        ->get();

        // $this->hospitals=  Landmark::where('const_id', $constituency_id)
        // ->where('tipo', 'hospital')
        // ->get();
    }


    public function filter_markets($county_id)
   
    {
        $this->markets=  Landmark::where('const_id', $county_id)
        ->where('tipo', 'market')
        ->get();


        // $this->hospitals=  Landmark::where('const_id', $constituency_id)
        // ->where('tipo', 'hospital')
        // ->get();

        // $this->hospitals=  Landmark::where('const_id', $constituency_id)
        // ->where('tipo', 'hospital')
        // ->get();
    }


    public function write_location_scope($county_id , $subcounty_id, $ward_id)
   
    {
        $this->county_name =     County::where('id',$county_id)->first()->county;
        $this->subcounty_name =  SubCounty::where('id',$subcounty_id)->first()->subcounty;
        $this->ward_name =  Ward::where('id',$ward_id)->first()->ward;
       
    }
    public function render()
    {
        return view('livewire.landmarksearch');
    }
}
