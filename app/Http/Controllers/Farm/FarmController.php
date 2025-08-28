<?php

namespace App\Http\Controllers\Farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Field;


class FarmController extends Controller
{
    //

    public function show_farm()
    {
        return view('farm.farm_list');

    }



    public function get_fields_from_farm(Request $request)
    {
        return $response= Field::where('farm_id',$request->id)->get();

    }


}
