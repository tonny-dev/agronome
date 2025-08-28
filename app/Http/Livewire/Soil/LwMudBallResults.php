<?php

namespace App\Http\Livewire\Soil;
use Livewire\Component;
use App\Models\FarmSoilTests;
use Illuminate\Support\Facades\Auth;


class LwMudBallResults extends Component
{

    public $results;
    public $recommendations;
    public $test_date;
    public $field_details;

    protected $listeners = [
        'mud_ball_outcome_selected' => 'show_result',
        'mud_ball_test_completed' => 'save_results',
    ];

    public function show_result($res ,$field_details)
    {
    

        $this->test_date  = date("Y-m-d");
        $this->field_details  = $field_details;
       
    
      if ($res == 'btn_retain_ball_shape_false')
    {
       
        $this->results = "The soil is Sand";
        $this->recommendations = "Add some clay";
    }

    if ($res == 'btn_short_ribbon_no')
    {
       
        $this->results = "The soil is Sandy loam";
        $this->recommendations = "Conduct chemical soil test";
    }
  

    if ($res == 'btn_semi_circle_no')
    {
       
        $this->results = "The soil is Loam";
        $this->recommendations = "Conduct chemical soil test";
    }


    if ($res == 'btn_cracks_yes')
    {
       
        $this->results = "The soil is light clay";
        $this->recommendations = "Conduct chemical soil test";
    }

    if ($res == 'btn_cracks_no')
    {
       
        $this->results = "The soil is heavy clay";
        $this->recommendations = "Conduct chemical soil test";
    }







    
    }


    public function save_results($farm_id, $field_id, $test_date)
    {

        FarmSoilTests::create(
            [
                'farmer_id' => Auth::user()->id,
                'farm_id' => $farm_id,
                'field_id' => $field_id,
                'test_id' => 1014,
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
        return view('livewire.soil.lw-mud-ball-results');
    }
}
