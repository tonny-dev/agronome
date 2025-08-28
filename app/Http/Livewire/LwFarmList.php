<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\User;
use App\Models\Farm;
use App\Models\Field;

class LwFarmList extends Component
{

    public $success = null;
    public $farms = [];
    public $fields = [];




    public function render()
    {
        $this->farms = Farm::where('farmer_id', Auth::user()->id)->get();
        return view('livewire.lw-farm-list')->with(["farms" => $this->farms]);
    }

    // This returns farm county based on the id passed
    // To be deleted incase better solution exists.
    public function getFarmCountyOnSelect($id)
    {
        $single_farm_id = Farm::find($id);
        $array_of_fields = Field::where('farm_id', $id)->get();
        
        foreach($array_of_fields as $single_field){
            $this->fields[] = $single_field->allocation;

        }
        $farm_details = array($single_farm_id->county['county'], $single_farm_id->ward['ward'], $single_farm_id->constituency['constituency'], $this->fields);

        return response()->json($farm_details);
    }

    public function delete($id)
    {
        if ($id) {

            Farm::where('id', $id)->delete();
            $this->success = 'The record has been successfully deleted';
        }
    }

    public function edit($id)
    {
    }
}
