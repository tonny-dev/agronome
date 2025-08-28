<?php

namespace App\Http\Controllers\Crop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CropController extends Controller
{
    //

    public function show_crops()
    {
        return view('crop.crop');

    }


    public function show_crop_farm_list()
    {
        return view('crop.crop_farm_list');
    }


    public function show_crop_farm_details()
    {
        return view('crop.crop_farm_details');
    }



}
