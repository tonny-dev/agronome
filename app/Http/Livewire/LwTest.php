<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LwTest extends Component
{

public $success;





public function testit()
{
    $this->success = "Bruno Mars";
}



    public function render()
    {
        return view('livewire.lw-test');
    }

    
}
