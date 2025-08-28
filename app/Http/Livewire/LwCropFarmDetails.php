<?php

namespace App\Http\Livewire;

use App\Models\Crop;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Farm;
use App\Models\Variety;
use App\Models\CropsFarm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LwCropFarmDetails extends Component
{

    public $go_crop = null;
    public $go_crop_farm = null;

    public $crop = null;
    public $crops = [];

    public $attribute = null;
    public $attributes = [];

    public $farm = null;
    public $farms = [];

    public $variety = null;
    public $varieties = [];
    public $edit_mode = false;

    public $success;
    public $blurb;
    public $allocation;
    public $planted_date;

    protected $listeners = [
        'crop_farm_selected' => 'load_modal',
        'add_cf' => 'clear_fields'
    ];


    protected $rules = [
        'allocation' => 'required',
        'attribute' => 'required',
        'crop' => 'required',
        'variety' => 'required',
        'farm' => 'required',
        'planted_date' => 'required',
    ];


    public function plant_crop()
    {
        $validated = $this->validate();
        CropsFarm::create(
            [
                'farmer_id' => Auth::user()->id,
                'farm_id' =>  $validated['farm'],
                'crop_id' =>  $validated['crop'],
                'variety_id' =>  $validated['variety'],
                'allocation' =>  $validated['allocation'],
                //'planted_date'=>date('Y-m-d H:i:s'),               
                'planted_date' => $validated['planted_date'],
            ]
        );

        $this->success = 'Action completed successfully';
        $this->clean_redirect();
    }




    public function store()
    {
        ($this->go_crop_farm) ? $this->update($this->go_crop_farm->id) : $this->plant_crop();
        // ($this->go_crop_farm) ? dd($this->varieties) : $this->plant_crop();
    }




    public function update($id)
    {
        $validated = $this->validate();


        DB::table('crops_farms')
            ->where('id', $id)
            ->update([
                'farmer_id' => Auth::user()->id,
                'farm_id' =>  $validated['farm'],
                'crop_id' =>  $validated['crop'],
                'variety_id' =>  $validated['variety'],
                'allocation' =>  $validated['allocation'],
                'updated_at' => date('Y-m-d H:i:s'),
                'planted_date' => $validated['planted_date'],
            ]);

        $this->success = 'Action completed successfully';

        $this->clean_redirect();
    }




    public function mount()
    {
       //  if (!$this->edit_mode) { $this->clear_fields(); }

        $this->crops = Crop::all();
        $this->farms = Farm::where('farmer_id', Auth::user()->id)->get();
    }



    public function load_modal($id)
    {

        $this->crop_farm_id = $id;

        $this->edit_mode = true;
        $this->success = null;

        $this->go_crop_farm =   CropsFarm::where('id', $id)->get()->first();
        $this->farm = $this->go_crop_farm->farm_id;
        $this->crop = $this->go_crop_farm->crop_id;

        $this->go_crop =   Crop::where('id', $this->crop)->get()->first();
        $this->varieties = $this->go_crop->get_varieties($this->crop);

        $this->variety = $this->go_crop_farm->variety_id;
        $this->allocation = $this->go_crop_farm->allocation;
        ///$this->planted_date = $this->go_crop_farm->planted_date->format('yyyy-MM-dd');
        $this->planted_date = Carbon::parse($this->go_crop_farm->planted_date)->format('Y-m-d');
    }


    public function load_crop($id)
    {
        $this->go_crop =   Crop::where('id', $this->crop)->get()->first();
        $this->attributes = $this->go_crop->get_attributes($this->crop);
    }

    public function clear_fields()
    {

        $this->success = null;

        $this->varieties = null;
        $this->crop = null;
        $this->attributes= null;


        $this->attribute = null;
        $this->variety = null;
        $this->blurb = null;
        $this->allocation = null;
        $this->crop= null;
        $this->planted_date=null;; 
    }

    public function updatedCrop()
    {
        $this->attributes = null;
        $this->varieties = null;
        $this->blurb = null;

        if ($this->crop) {
            $this->load_crop($this->crop);
        }
    }

    public function updatedAttribute()
    {
        $this->varieties = null;
        if ($this->attribute && $this->crop) {
            $this->varieties = $this->go_crop
                ->get_varieties_with_attribute($this->crop, $this->attribute);
        }
    }


    public function updatedvariety()
    {
        if ($this->variety && $this->attribute && $this->crop) {

            $this->varieties = $this->go_crop
                ->get_varieties_with_attribute($this->crop, $this->attribute);
            $this->attributes = $this->go_crop->get_attributes($this->crop);

            $this->blurb = Variety::where('id', $this->variety)->first()->blurb;
        }
    }


    public function render()
    {

        if ($this->crop) {
            $this->load_crop($this->crop);
        }
      
        if ($this->edit_mode)
         {
             $this->varieties = $this->go_crop->get_varieties($this->crop);
         }

         if ($this->attribute) {
            $this->varieties = $this->go_crop->get_varieties_with_attribute($this->crop, $this->attribute);
        }

        return view('livewire.lw-crop-farm-details');
    }

    public function clean_redirect()
    {

        $this->emit('cf_redirect');
    }
}
