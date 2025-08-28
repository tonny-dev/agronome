<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Farm;
use App\Models\Crop;
use App\Models\Variety;
use App\Models\CropsFarm;
use App\Models\PlantHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LwMonitoring extends Component
{
    public $activities = [];
    //    public $activity = null;

    public $fields = [];
    public $field = null;

    public $actions = [];
    public $action = null;


    public $success;
    public $edit_mode = false;

    public function mount()

    {

        $this->fields =   DB::table('v_crops_farms')
            ->select('*')
            ->where('farmer_id', '=', Auth::user()->id)
            ->get();
    }


    public function updatedField()
    {

        $this->actions = null; 
        $this->action = null; 
        $this->activities = null;  /*very important to nullify child itme*/


       if ($this->field) {  $this->itHurts(); }
    }


    public function updatedAction()
    {
   
        if ($this->action) {  $this->itHurts(); }   
     
    }


    public function perform_action()
    {
        PlantHistory::create(
            [
                'crop_farm_id' => $this->field,
                'growth_stage_id' =>  $this->action,
                'notes' => 'am always angry',                
                'completed_on'=>date('Y-m-d H:i:s'),             
            ]
        );
        
        
        $this->success = $this->action;
    }



    public function name_field($field_coll)
    {

        // return  Farm::where('id', $field_coll->farm_id)->first()->name . '//' .
        //     Crop::where('id', $field_coll->crop_id)->first()->name . '//' .
        //     Variety::where('id', $field_coll->variety_id)->first()->name;
    }


    public function itHurts()

    {

        $this->fields =   DB::table('v_crops_farms')
            ->select('*')
            ->where('farmer_id', '=', Auth::user()->id)
            ->get();

        if ($this->field && $this->fields) {
            $this->activities = DB::table('v_crop_history')
                ->select('*')
                ->where('crop_farm_id', '=', $this->field)
                ->get();
            

            $this->actions =   DB::table('activities')
                ->select('id', 'crop_id', 'activity')
                ->where('crop_id', '=',  CropsFarm::where('id', $this->field)->first()->crop_id)
                ->get();
        }
    }



    public function render()
    {
      //  $this->itHurts();
        return view('livewire.lw-monitoring');
    }
}
