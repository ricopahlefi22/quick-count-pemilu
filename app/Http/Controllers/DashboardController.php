<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Monitor;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use App\Models\WebConfig;
use App\Models\Witness;

class DashboardController extends Controller
{
    function ownerDashboard()
    {
        $data['title'] = 'Beranda';
        $data['districts'] = District::all();
        $data['villages'] = Village::all();
        $data['voting_places'] = VotingPlace::all();
        $data['voters_count'] = Voter::whereNotNull('district_id')->whereNotNull('village_id')->whereNotNull('voting_place_id')->count();
        $data['self_voters_count'] = Voter::whereNotNull('coordinator_id')->count();
        $data['coordinators_count'] = Voter::where('level', 1)->count();

        if (env('WITNESSES') == true) {
            $data['witnesses_count'] = Witness::count();
        }

        if (env('MONITORS') == true) {
            $data['monitors_count'] = Monitor::count();
        }

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
