<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    function coordinatorMember()
    {
        $pdf = Pdf::loadView('print-pdf.coordinator-member')->setPaper('A4', 'landscape');

        // return $pdf->stream();
        return view('print-pdf.coordinator-member');
    }
}
