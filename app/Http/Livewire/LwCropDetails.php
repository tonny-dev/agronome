<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Crop;

class LwCropDetails extends Component
{
    public $crop_name;
    public $blurb;
    public $soil_blurb;
    public $pests = [];
    public $diseases =[];
    public $farms =[];
    


    protected $listeners = ['crop_selected'=>'get_details'];


    public function render()
    {
        return view('livewire.lw-crop-details', compact($this->pests));
    }


    public function get_details($id)
    {
        $crop =   Crop::where('id', $id)->get()->first();

        $this->blurb = $crop->blurb;
        $this->crop_name = $crop->name;
        $this->soil_blurb = $crop->soil_blurb;
        $this->pests = $crop->get_pests($id);
        $this->diseases =$crop->get_diseases($id);

        $this->emit('crop_loaded', $id);
    }
}
