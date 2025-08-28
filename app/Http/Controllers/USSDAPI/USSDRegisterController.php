<?php

namespace App\Http\Controllers\USSDAPI;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class USSDRegisterController extends Controller{  

    public $DUPLICATE_NUMBER = 200;
    public $BLANK_FIRST_NAME = 202;
    public $OTHER_NAMES_EMPTY = 203;
    public $BLANK_PASSWORD = 204;
    public $PASSWORD_TOO_SHORT = 205;
    public $WRONG_NO_FORMAT =201;  
    public $MOBILE_NULL =206; 
    PUBLIC $SUCCESSFUL_REGISTRATION = 100;


    public $response;
   

    public function register(Request $request)
    {     
        
    $this->response = response()->json( ['response code' => 666], 400);  

    if ($this->validate_request($request))
    {
        $this->create_user($request); 
    }    
    return  $this->response;

    }

    
  protected function validate_request(Request $request) 
  {      
      if (empty($request->input('first_name')))    {  $this->create_response($this->BLANK_FIRST_NAME); return false; }  
      if (empty($request->input('other_names')))   {  $this->create_response($this->OTHER_NAMES_EMPTY); return false; }  
      if (empty($request->input('password')))      {  $this->create_response($this->BLANK_PASSWORD); return false; }  
      if (empty($request->input('mobile') ))       {  $this->create_response($this->MOBILE_NULL); return false; }  
      if ($this->check_if_exists($request->input('mobile')))   {  $this->create_response($this->DUPLICATE_NUMBER); return false; }      
                    if (strlen($request->input('mobile')) < 12 )    {  $this->create_response($this->WRONG_NO_FORMAT); return false; }   /* what if it is longer ?*/
      if (strlen($request->input('password')) < 4 )    {  $this->create_response($this->PASSWORD_TOO_SHORT); return false; }
   
      return true;       

  }

    protected function create_user(Request $request)
    {     
        
         User::create([
            'first_name' =>  $request->input('first_name'),
            'other_names'=>  $request->input('other_names'),
            'password' => Hash::make($request->input('passworrd')), 
            'registered_from' =>  'USSD',   
            'mobile' =>  $request->input('mobile')                                    
        ]);  
        
        $this->create_response($this->SUCCESSFUL_REGISTRATION); 
    }


  private function  create_response($code)
    {
        $this->response = response()->json( ['response' => $code], 400);  
    }

    private function  check_if_exists($number)
    {
        $exists =false;
        if (User::where('mobile', '=', $number)->exists())
         {
            $this->response = response()->json( ['response_code' => $this->DUPLICATE_NUMBER], 400);  
            $exists =true;
         }

         return $exists;
    }


}