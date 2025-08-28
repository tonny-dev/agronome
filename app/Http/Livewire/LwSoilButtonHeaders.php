<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Farm;
use Illuminate\Support\Facades\Auth;
use App\Models\Field;
use App\Models\Systype;
use Carbon\Carbon;

class LwSoilButtonHeaders extends Component
{




    public $fields = [];
    public $field;
    public $allocation = "Size";

    public $farms = [];
    public $farm;


    public $test_tipos = [];
    public $testTipo;


    public $soil_tests = [];
    public $soilTest;
    public $test_date;
    public $mono_allocation;

    // ...



    public function mount()
    {
        $this->farms = Farm::where('farmer_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $this->test_tipos = Systype::where('tipo', 'soil_test_type')->orderBy('id', 'desc')->get();
        $this->test_date  = Carbon::today()->format('Y-m-d');
    }



    public function render()
    {
        return view('livewire.lw-soil-button-headers');
    }


    // updates farm with details when it is selected
    public function updatedfarm()
    {

        $farm = Farm::find($this->farm);
        $myFields = Field::where('farm_id', $this->farm)->orderBy('id', 'desc')->get();

        if ($farm && $myFields->isNotEmpty()) {
            $this->fields = $myFields;
            $this->allocation = $farm->farm_size;
        } elseif ($farm) {
            $this->fields = 0;
            $this->mono_allocation = $farm->farm_size;
        }

        $this->send_selection_details();
    }


    // called when selecting test type
    public function updatedsoilTest()
    {

        $this->send_selection_details();
    }



    public function send_selection_details()
    {

        $this->emit('selection_made', $this->farm, $this->field, $this->soilTest);
    }



    public function updatedtestTipo()
    {
        // In any case a tipo is selected and swal shown, run the before if
        if (!$this->testTipo) {
            $this->testTipo = null;
            $this->soil_tests = collect(); // Set an empty collection
            return;
        }

        $this->soil_tests =  Systype::where('padre', $this->testTipo)->orderBy('id', 'desc')->get();
    }


    // Called when the field is selected to update allocation
    public function updatedfield()

    {

        $mixed_field = Field::where('id', $this->field)->first();
        if ($mixed_field == null) {
            $this->allocation = $this->mono_allocation;
        } else {
            $this->allocation = $mixed_field->allocation;
        }

        $this->send_selection_details();
    }
}
