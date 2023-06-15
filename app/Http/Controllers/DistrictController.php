<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    function index()
    {
        $data['districts'] = District::all();
        return view('admin.district.index', $data);
    }
}
