<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Farm;
use App\Models\Variety;
use App\Models\CropsFarm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LwCropFarmList extends Component
{

    public $plantings = [];

    public $success = null;
    public $farms = [];
    public $farm_id;

    protected $listeners = [
        'farm_selected' => 'filter_by_farm',
    ];


    public function mount()

    {
    }



    public function delete($id)
    {

        if ($id) {

            CropsFarm::where('id', $id)->delete();
            $this->success = 'The record has been successfully deleted';
            $this->emit('cf_redirect');
        }
    }


    public function filter_by_farm($id)
    {

        $this->farm_id = $id;
    }




    public function render()
    {

        $this->plantings = DB::table('v_crops_farms')
            ->select('*')
            ->where('farmer_id', '=', Auth::user()->id)
            ->get();

        if ($this->farm_id) {
            $this->plantings = DB::table('v_crops_farms')
                ->select('*')
                ->where('farmer_id', '=', Auth::user()->id)
                ->where('farm_id', '=', $this->farm_id)
                ->get();
        }

        return view('livewire.lw-crop-farm-list');
    }
}
