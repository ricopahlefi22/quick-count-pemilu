<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function ownerDashboard()
    {
        $data['title'] = 'Beranda';
        $data['coordinators'] = Voter::where('level', 1)->count();
        $data['voters'] = Voter::where('level', 0)->whereNotNull('coordinator_id')->count() + $data['coordinators'];

        return view('owner.dashboard', $data);
    }

    function adminDashboard()
    {
        $data['title'] = 'Beranda';
        if (WebConfig::first()->strict == false) {
            $data['coordinators'] = Voter::where('level', 1)->count();
            $data['voters'] = Voter::where('level', 0)->whereNotNull('coordinator_id')->count() + $data['coordinators'];
        }

        return view('admin.dashboard', $data);
    }
}
