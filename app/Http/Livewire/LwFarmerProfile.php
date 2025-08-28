<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use App\Models\County;

class LwFarmerProfile extends Component
{

    public $first_name;
    public $success;
    public $other_names;
    public $address;
    public $email;
    public $county;
    public $gender;
    public $dob;
    public $mobile;
    public $kra_pin;
    public $secondary_mobile;
    public $secondary_email;
    public $national_id;
    public $counties = [];

    // 'secondary_email'=>'required|email|unique:users', maybe a farmer ca use other persons email as secondary

    protected $rules = [
        'first_name' => 'required|min:2',
        'other_names' => 'required|min:2',
        'address' => 'required',
        'gender' => 'required',
        'mobile' => 'required|string|size:10',
        'national_id' => 'required|min:6|unique:users',
        'secondary_mobile' => ['required', 'digits:10', 'regex:/^07\d{8}$/', 'unique:users'],
        'national_id' => 'required|unique:users|min:6|unique:users|numeric',
        'kra_pin' => ['required', 'regex:/^[A-Z]\d{9}[A-Z]$/', 'size:11', 'unique:users'],
        'dob' => ['required','date','after_or_equal:1930-01-01','before:-18 years'],
        'county' => 'required',
        'secondary_email'=>'required|email'
    ];


    public function mount()

    {

        $this->first_name = Auth::user()->first_name;
        $this->other_names = Auth::user()->other_names;
        $this->email = Auth::user()->email;
        $this->kra_pin = Auth::user()->kra_pin;
        $this->secondary_email = Auth::user()->secondary_email;
        $this->address = Auth::user()->address;
        $this->county = Auth::user()->county_id;
        $this->gender = Auth::user()->gender;
        $this->dob = Auth::user()->dob;
        $this->mobile = Auth::user()->mobile;
        $this->secondary_mobile = Auth::user()->secondary_mobile;
        $this->national_id = Auth::user()->national_id;
    }


    public function update_farmer_profile(Request $request)
    {

        $validated = $this->validate();

        // dd("Caliing this method");
        User::whereId(Auth::user()->id)->update(
            [
                'first_name' => $this->first_name,
                'other_names' => $this->other_names,
                'address' => $this->address,
                'kra_pin' => $this->kra_pin,
                'secondary_email' => $this->secondary_email,
                'secondary_mobile' => $this->secondary_mobile,
                'gender' => $this->gender,
                'mobile' => $this->mobile,
                'national_id' => $this->national_id,
                'dob' => $this->dob,
                'county_id' => $this->county,
            ]
        );


        User::whereId(Auth::user()->id)->update(['profile_completed_at' => date('Y-m-d H:i:s')]);

        $this->success = 'Profile updated  successfully';
    }

    public function render()
    {
        $this->counties = County::orderBy('county')->get();
        return view('livewire.lw-farmer-profile');
    }
}
