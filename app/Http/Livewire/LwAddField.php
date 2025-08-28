<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Field;
use App\Models\Systype;
use Illuminate\Support\Facades\Auth;

class LwAddField extends Component
{
    public $fieldSize = null;
    public $field_number = 1;

    public $farm_size   = null;

    public $field_name   = null;
 
    public $progress_string   = null;
    public $cumulative_size = 0;

    public $farming_types = [];
    public $farming_type = null;

    public $field_collection;
    


    public $created_field = "bypass";



    protected $listeners = [
    'field_added' => 'generate_field_name' ,
    'farm_created' => 'create_fields'
];



   
    public function mount()
    {
        $this->field_collection = collect();
        $this->farming_types = Systype::where('tipo','farm_type')->get();
    }



    

    public function create_fields($farm_id)
    {

        foreach($this->field_collection as $field ) {

         Field::create([
                'farmer_id' => Auth::user()->id,
                'farm_id' => $farm_id,
                'name' => $field["field_name"],
                'allocation' => $field["fieldSize"] ,       
                'updated_by' => Auth::user()->id
            ]);         
          }

          $this->emit('fields_created');
    }



    public function UpdatedFieldSize()
    {
        $this->field_name = 'F-'.$this->fieldSize;
    }


    public function field_reset()
    {

    // reset  collection;
    $this->field_collection = collect();

    }


    // public function compute_progress($farm_size)
    // {
    //     $this->farm_size = $farm_size;
    //     $this->cumulative_size += $this->fieldSize;
    //     $this->progress_string = $this->cumulative_size. ' of '.$this->farm_size . ' acres used' ;
    // }

    public function generate_field_name($farm_name ,$fieldSize)
    {

        $this->field_name = 'F-'.strtoupper(substr($farm_name,0,4)).$this->field_number.'-'.$this->fieldSize;
        $this->field_number ++;
        
      
        $this->field_collection->push( 
            [   
                'field_name' => $this->field_name,
                'fieldSize' =>  $fieldSize
               
            ]
        );

        $this->fieldSize = 0;

    }



    public function render()
    {
        return view('livewire.lw-add-field');
    }
}