<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |Got rid of laravel magics because botido-2020 
    |
    */

   
    protected $redirectTo = RouteServiceProvider::HOME;
       

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest');
         
    }

    

    public function register(Request $request)
    {
        
        $validatedData = $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'other_names' => ['required', 'string', 'max:255'],           
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'mobile' =>['required','string','min:10','max:10','unique:users'],
        
    ]);


        $user = $this->create_user($validatedData);       

        event(new Registered(($user)));
        
        return view('success_register');

    }


    public function show_register()
    {
                
        return View::make('auth.register');//->with(["profiles"=>$this->profiles]);
    }

 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */ 
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
}