<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LwMonitoringAction extends Component
{


    public $edit_mode = false;


    public function render()
    {
        return view('livewire.lw-monitoring-action');
    }
}
