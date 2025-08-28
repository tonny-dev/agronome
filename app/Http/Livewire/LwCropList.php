<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Crop;



class LwCropList extends Component
{

public $crops = [];



public function mount()
{
        $this->crops =  Crop::orderBy('name')->get();
}



    public function render()
    {
        return view('livewire.lw-crop-list');
    }







}
