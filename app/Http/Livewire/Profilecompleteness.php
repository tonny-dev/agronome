<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profilecompleteness extends Component
{

    public $check_completeness = 0;


    public function mount()
    {
        $this->check_completeness = $this->checkprofilecompleteness();
    }


    public function render()
    {
        return view('livewire.profilecompleteness');
    }

    public function checkprofilecompleteness()
    {
        $filled_fields = 0;
        $fields_to_check = [
            'first_name',
            'other_names',
            'email',
            'mobile',
            'county_id',
            'dob',
            'gender',
            'national_id',
            'kra_pin',
            'secondary_email',
            'address',
            'secondary_mobile',
        ];

        foreach($fields_to_check as $field_to_check){
            if(!empty(Auth::user()->$field_to_check)){
                $filled_fields++;
            }
        }
        // $percentage = ( $filled_fields / $total_fields)*100;
        // return number_format((float)$percentage, 0, '.', '');

        return round(($filled_fields / count($fields_to_check)) * 100);
    }
}

