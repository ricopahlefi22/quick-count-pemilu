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
        $data['members'] = Voter::where('coordinator_id', $data['voter']->id)->orderBy('level', 'desc')->get();

        $pdf = Pdf::loadView('print-pdf.coordinator-member', $data)->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
