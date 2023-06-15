<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function admin(){
        $data['title'] = 'Data Profil';
        return view('profile.admin', $data);
    }
}
