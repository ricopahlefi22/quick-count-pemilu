<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MappingVoterController extends Controller
{
    function village(Request $request)
    {
        $data['title'] = 'Peta Pemilih';
        return view('owner.mapping-voter.village', $data);
    }
}
