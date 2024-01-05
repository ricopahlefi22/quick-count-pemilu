<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;


class PrintController extends Controller
{
    function coordinatorMember(Request $request){

        // data
     $data['voter'] = Voter::findOrFail(Crypt::decrypt($request->id));
     $data['title'] = 'Detail Data ' . $data['voter']->name;
     $data['districts'] = District::all();
     $data['members'] = Voter::where('coordinator_id', $data['voter']->id)->orderBy('level', 'desc')->get();

        // end data
    // $pdf = Pdf::loadView('print-pdf.coordinator-member')->setPaper('A4', 'landscape');

    return view('print-pdf.coordinator-member', $data);
}

}
