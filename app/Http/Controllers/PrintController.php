<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Voter;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class PrintController extends Controller
{
    function coordinatorMember(Request $request)
    {
        $data['voter'] = Voter::findOrFail(Crypt::decrypt($request->id));
        $data['title'] = 'Detail Anggota ' . $data['voter']->name;
        $data['web'] = WebConfig::first();
        $data['member_same_voting_place'] = Voter::where('coordinator_id', $data['voter']->id)->where('voting_place_id', $data['voter']->voting_place_id)->orderBy('level', 'desc')->get();
        $data['member_not_same_voting_place'] = Voter::where('coordinator_id', $data['voter']->id)->where('voting_place_id', '!=', $data['voter']->voting_place_id)->orderBy('village_id', 'asc')->get();

        $data['members'] = $data['member_same_voting_place']->merge($data['member_not_same_voting_place']);

        if($data['voter']->level == 1){
            $pdf = Pdf::loadView('print-pdf.coordinator-member', $data)->setPaper('A4', 'landscape');

            return $pdf->stream();
        } else {
            return abort('404');
        }
    }
}
