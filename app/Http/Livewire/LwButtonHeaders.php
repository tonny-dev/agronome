<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Farm;
use Illuminate\Support\Facades\Auth;
 

class LwButtonHeaders extends Component
{


public $farms= null;


   public function mount()
   {
    $this->farms = Farm::where('farmer_id',Auth::user()->id) ->orderBy('id','desc')->get();
   }


    public function render()
    {
        return view('livewire.lw-button-headers');
    }
}
