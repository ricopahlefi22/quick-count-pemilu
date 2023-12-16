<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingResult;
use App\Models\WebConfig;
use App\Models\Candidate;
use App\Models\Party;

class TvController extends Controller
{
    function tv(){

        return view('tv');
    }
}
