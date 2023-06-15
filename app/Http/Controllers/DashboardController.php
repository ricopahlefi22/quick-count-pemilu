<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
    {
        $data['title'] = 'Beranda';
        $data['coordinators'] = Voter::where('level', 1)->count();
        $data['voters'] = Voter::where('level', 0)->whereNotNull('coordinator_id')->count() + $data['coordinators'];

        return view('admin.dashboard', $data);
    }
}
