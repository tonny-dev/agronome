<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class USSDEditFarmerController extends Controller
{
    



    public $SUCCESSFUL_UPDATE = 700;    
    public $USER_DOES_NOT_EXIST = 701;  
    public $INVALID_UPDATE_KEY  = 703;    
    public $NULL_UPDATE_VALUE  = 702;    

    public $response;

    public $mobile;
    public $update_key;
    public $update_value;

    public function update_farmer(Request $request)
    {    
        

    $this->mobile = $request->input('mobile');
    $this->update_key = $request->input('update_key');
    $this->update_value = $request->input('update_value');
 

    if( $this->check_if_exists($request->input('mobile')) )
    {
       
        if ($this->validate_request($request))        
        {
               if ($request->input('update_key') == 'password' ) {Hash::make($request->input('update_value')); }
                DB::table('users')->where('mobile', $this->mobile)->update(array($request->input('update_key') => $request->input('update_value')));
                $this->create_response($this->SUCCESSFUL_UPDATE);
        }

    }    

    return  $this->response;

    }

    
    private function  check_if_exists($number)
    {
     $exists =true;
        if  (!User::where('mobile', '=', $number)->exists())
         {
            $this->response = response()->json( ['response_code' => $this->USER_DOES_NOT_EXIST], 400);  
            $exists =false;
         }

         return $exists;
    }





  protected function validate_request(Request $request) 
  {      
        
    $is_valid = true;


    if  ( empty( $request->input('update_value'))) {  $this->response = response()->json( ['response_code' => $this->NULL_UPDATE_VALUE], 400);  $is_valid = false; }
    if  ( empty( $request->input('update_key'))) {  $this->response = response()->json( ['response_code' => $this->INVALID_UPDATE_KEY], 400);  $is_valid = false; }

// dd($this->response);

    return $is_valid;

  }



  private function  create_response($code)
    {
        $this->response = response()->json( ['response' => $code], 400);  
    }












}
