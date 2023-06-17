<?php

namespace App\Http\Controllers;

use App\Exports\VotingPlaceExport;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function export(Request $request)
    {
        $tps = VotingPlace::findOrFail($request->tps);

        return Excel::download(new VotingPlaceExport($request->tps), Str::random(8) . '-' . $tps->village->name . '-TPS' . $tps->name . '.xlsx');
    }
}
