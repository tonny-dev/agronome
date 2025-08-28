<?php

namespace App\Http\Livewire\Soil;
use Livewire\Component;
use App\Models\FarmSoilTests;
use Illuminate\Support\Facades\Auth;


class LwSqueezeBallResults extends Component
{

    public $results;
    public $recommendations;
    public $test_date;
    public $field_details;

    protected $listeners = [
        'squeeze_ball_outcome_selected' => 'show_result',
        'squeeze_ball_test_completed' => 'save_results',
    ];


    public function show_result($res ,$field_details)
    {

        $this->test_date  = date("Y-m-d");
        $this->field_details  = $field_details;
    
    if ($res == true)
    {
          $this->results = "The soil has enough clay";
          $this->recommendations = "Add some sand";
        
    } 
    
      if ($res == false)
    {
        $this->results = "The soil has enough sand";
        $this->recommendations = "Add some clay";
    }
    
    }


    public function save_results($farm_id, $field_id, $test_date)
    {
        $field_id_value = ($field_id === null) ? 0 : $field_id;


        FarmSoilTests::create(
            [
                'farmer_id' => Auth::user()->id,
                'farm_id' => $farm_id,
                'field_id' => $field_id_value,
                'test_id' => 1018,
                'results' => $this->results,
                'recommendations' => $this->recommendations,
                'percent_completed' => 100,
                'test_date' => $test_date
            ]
        );

        $this->emit('soil_test_concluded',$farm_id,$field_id); /*LWPhysicalTests test is listening to update status*/
    }

    public function render()
    {
        return view('livewire.soil.lw-squeeze-ball-results');
    }
}
