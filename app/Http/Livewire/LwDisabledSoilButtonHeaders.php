<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LwDisabledSoilButtonHeaders extends Component
{

    public $fields = [];
    public $field;
    public $allocation = 0;

    public $farms=[];
    public $farm;


    public $test_tipos=[];
    public $testTipo;


    public $soil_tests=[];
    public $soilTest;
    public $test_date;

    public function render()
    {
        return view('livewire.lw-disabled-soil-button-headers');
    }
}
