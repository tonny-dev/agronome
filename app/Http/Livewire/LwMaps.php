<?php

namespace App\Http\Livewire;

use GrahamCampbell\ResultType\Success;
use Livewire\Component;

class LwMaps extends Component
{
   public $success = null;


   protected $listeners = [
    'markerDrawn' => 'store_gis_data'   
];



public function store_gis_data($data)
{

    $this->success = $data;
}


    public function render()
    {
        return view('livewire.lw-maps');
    }
}
