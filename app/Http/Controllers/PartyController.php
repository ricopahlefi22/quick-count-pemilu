<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PartyController extends Controller
{
    function index()
    {
        $data['title'] = 'Data Partai';
        $data['parties'] = Party::all();

        if (Auth::guard('owner')->check()) {
            return view('owner.party.index', $data);
        }
    }

    function detail(Request $request)
    {
        $data['title'] = 'Detail Partai';
        $data['party'] = Party::findOrFail(Crypt::decrypt($request->id));

        if (Auth::guard('owner')->check()) {
            return view('owner.party.detail', $data);
        }
    }
}
