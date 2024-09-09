<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function getDistricts($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();

        return response()->json($districts);
    }
    public function getWards($district_id)
    {
        $wards = Ward::where('district_id', $district_id)->get();

        return response()->json($wards);
    }
}
