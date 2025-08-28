<?php

namespace App\Http\Livewire;
use App\Models\Farm;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class LwPhysicalTests extends Component
{

    public $throw_ball_percentage = '0';
    public $manipulative_percentage = '0';
    public $ribbon_ball_percentage = '0';
    public $squeeze_ball_percentage = '0';

    protected $listeners = [
        'selection_made' => 'show_completion_status',
        'soil_test_concluded' => 'show_completion_status',
    ];



    public function show_completion_status($farm, $field )
    {
        if (is_null($field)) {$field = 0;} /*for where farm is not subdivided into fields or where no field is selected*/

        $this->throw_ball_percentage   =    $this->get_percentage($farm,$field,1017);
        $this->manipulative_percentage   =    $this->get_percentage($farm,$field,1019);
        $this->ribbon_ball_percentage   =    $this->get_percentage($farm,$field,1014);
        $this->squeeze_ball_percentage   =    $this->get_percentage($farm,$field,1018);

    }


    public  function get_percentage($farm , $field , $test)
    {
       
      $percentage =   DB::table('farm_soil_tests')
        ->select('percent_completed')
        ->where('farm_id', $farm)
        ->where('test_id', $test)
        ->where('field_id',$field)
        ->pluck('percent_completed')
    ->first();

       if  (is_null($percentage)) { $percentage = '0';}

       return $percentage;

    }




    public function render()
    {
        return view('livewire.lw-physical-tests');
    }
}