<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



class Register extends Component
{


    // protected $redirectTo = RouteServiceProvider::HOME;
    public $email = '';
    public $first_name = '';
    public $other_names = '';
    public $password = '';
    public $mobile = '';
    public $passwordConfirmation = '';
       

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function mount()
    {

        // return view('register');
         
    }




    protected function create_user(array $data)
    {

        //return User::create($this->validatedData);
        
        return User::create([
            'first_name' =>  $data['first_name'],
            'other_names'=>  $data['other_names'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']), 
            'mobile' =>  $data['mobile'],                               
                                    
        ]);

    }

    

    public function register(Request $request)
    {

       //php dd($request);
        
    //     $validatedData = $request->validate([
    //     'first_name' => ['required', 'string', 'max:255'],
    //     'other_names' => ['required', 'string', 'max:255'],           
    //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //     'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     'mobile' =>['required','string','min:10','max:10','unique:users'],
        
    // ]);

        // $user = $this->create_user($validatedData);       
        // event(new Registered(($user)));
    //    return view('success_register');
  //    return redirect('/');

    }


   


    public function render()
    {
        
        return view('livewire.register');
    }

}
