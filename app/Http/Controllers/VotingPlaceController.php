<?php

namespace App\Http\Controllers;

use App\Models\VotingPlace;
use Illuminate\Http\Request;

class VotingPlaceController extends Controller
{
    function index()
    {
        return view('admin.voting-place.index');
    }

    function json(Request $request)
    {
        $votingPlace = VotingPlace::where('village_id', $request->village_id)->get();
        return response()->json($votingPlace);
    }
}
