<?php

namespace App\Http\Livewire;

use Livewire\Component;




class LwThrowBallQuestions extends Component
{




    public function stuck_together_true()
    {
      $this->emit('stuck_together', true);
    }

    public function stuck_together_false()
    {
      $this->emit('stuck_together', false);
    }

 

    public function render()
    {
        return view('livewire.lw-throw-ball-questions');
    }

}
