<?php

namespace App\Http\Livewire\Soil;

use Livewire\Component;
use App\Models\FarmSoilTests;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Contracts\Highlighter;

class LwManipulativeResults extends Component
{


    public $results;
    public $recommendations;
    public $test_date;
    public $field_details;

    protected $listeners = [
        'manipulative_outcome_selected' => 'show_result',
        'manipulative_test_completed' => 'save_results',
    ];

    public function show_result($res ,$field_details)
    {

        $this->test_date  = date("Y-m-d");
        $this->field_details  = $field_details;
    
            if ($res == 'high')
            {
                $this->results = "The soil offered high resistance to dry crushing";
                $this->recommendations = "Conduct more tests";
                
            } 
            
            if ($res == 'low')
            {
                $this->results = "The soil offered little resistance to dry crushing - probable soils : fine sand,fine loamy sand or soil with little clay present";
                $this->recommendations = "Conduct more test";
            }

        
            if ($res == 'med')
            {
                $this->results = "The soil offered medium resistance - is likely silty clay or sandy clay";
                $this->recommendations = "Conduct more tests";
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
                'test_id' => 1019,
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
        return view('livewire.soil.lw-manipulative-results');
    }
}
