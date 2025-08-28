<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\County;
use App\Models\Ward;
use App\Models\Subcounty;

class LwLegal extends Component

{

    public $county_name;
    public $subcounty_name;
    public $ward_name;

    public $subcounties = [];

    protected $listeners = ['ward_selected' => 'write_location_scope' ];




    public function write_location_scope($county_id , $subcounty_id, $ward_id)
   
    {
        $this->county_name =     County::where('id',$county_id)->first()->county;
        $this->subcounty_name =  SubCounty::where('id',$subcounty_id)->first()->subcounty;
        $this->ward_name =  Ward::where('id',$ward_id)->first()->ward;
       
    } 



    public function render()
    {
        return view('livewire.lw-legal');
    }
}
