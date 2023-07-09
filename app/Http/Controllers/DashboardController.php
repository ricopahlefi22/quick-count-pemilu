<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function ownerDashboard()
    {
        $data['title'] = 'Beranda';
        $data['districts'] = District::all();
        $data['villages'] = Village::all();
        $data['voting_places'] = VotingPlace::all();
        $data['voters_count'] = Voter::count();
        $data['self_voters_count'] = Voter::whereNotNull('coordinator_id')->count();

        return view('owner.dashboard', $data);
    }

    function adminDashboard()
    {
        $data['title'] = 'Beranda';
        $data['districts'] = District::all();
        $data['villages'] = Village::all();
        $data['voting_places'] = VotingPlace::all();
        $data['voters_count'] = Voter::count();


        if (WebConfig::first()->strict == false) {
            $data['coordinators'] = Voter::where('level', 1)->count();
            $data['voters'] = Voter::where('level', 0)->whereNotNull('coordinator_id')->count() + $data['coordinators'];
        }

        return view('admin.dashboard', $data);
    }
}
