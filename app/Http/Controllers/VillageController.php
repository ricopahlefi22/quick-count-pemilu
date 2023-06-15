<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    function index()
    {
        return view('admin.village.index');
    }

    function json(Request $request)
    {
        $village = Village::where('district_id', $request->district_id)->get();
        return response()->json($village);
    }
}
