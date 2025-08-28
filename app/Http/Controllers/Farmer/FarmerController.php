<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Farm;
use App\Models\Landmark;
use App\Models\County;
use RecursiveIteratorIterator;
use RecursiveArrayIterator;
use App\Models\Ward;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Constituency;



class FarmerController extends Controller
{

    public $farms=null;
    public $current_farm = null;    

    public function __construct()
    {
      $this->middleware('verified'); 
        
    }


    public function show_dashboard()
    {    
        $this->farms = Farm::where('farmer_id',Auth::user()->id) ->orderBy('id','desc')->get();
        $this->current_farm = $this->farms->first();          
        return view('farmer.farmer_dashboard')->with(["farms"=>$this->farms , "current_farm"=>$this->current_farm ]);
    }

 
    public function get_farm_by_id(Request $request)
     
    {        
       return $response= Farm::where('id',$request->id)->get()->first();
    }


    public function get_ward_coords(Request $request)
     
    {        
       return $response= Ward::where('id',$request->id)->get()->first();
    }

    public function get_landmark_coords(Request $request)
     
    {        
       return $response= Landmark::where('id',$request->id)->get()->first();
    }


    public function get_constituency_coords(Request $request)
     
    {        
       return $response= Constituency::where('id',$request->id)->get()->first();
    }


    public function update_profile(Request $request, User $user)
    {        
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:2'],        
        ]);

       return redirect()
       ->back();      
    }

 // API ROUTES








}
 