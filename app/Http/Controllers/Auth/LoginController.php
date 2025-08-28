<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{
    public $visit_no=0;
 
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Got rid of laravel's default handling because of too much magic
    |
    */



    public function login(Request $request)
    
    {        

        $this->middleware('auth')->except(['logout', 'success_verify']);
        

        if (Auth::attempt($this->credentials($request)))
        {
            $request->session()->regenerate();
            $this->visit_no = ++Auth::user()->visit_no; 

            DB::table('users')
            ->where('id',Auth::user()->id)
            ->update( ['visit_no'=>$this->visit_no ]);

            return redirect()->intended('farmer_dashboard');
        }
                

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }                   


    protected function credentials(Request $request)
        {
          if(stripos($request->get('email'),'@'))
          {
            return ['email'=>$request->get('email'),'password'=>$request->get('password')];
          }     

            return ['mobile' => $request->get('email'), 'password'=>$request->get('password')];
        }

    public function show_login()
    {
        return view('auth.login');
      
    }


    public function logout(Request $request) 
    {      
        Auth::logout();
        // $request->session()->invalidate();
        //$request->session()->regenerateToken();    
        return redirect('/');

    }









}