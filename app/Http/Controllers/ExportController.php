<?php

namespace App\Http\Controllers;

use App\Exports\VillageExport;
use App\Exports\VotingPlaceExport;
use App\Models\Village;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function export(Request $request)
    {
        if($request->tps){
            $tps = VotingPlace::findOrFail($request->tps);

            return Excel::download(new VotingPlaceExport($request->tps), '['.Str::random(8) . '] ' . $tps->village->name . ' - TPS ' . $tps->name . '.xlsx');
        }

        if($request->vllg){
            $vllg = Village::findOrFail($request->vllg);

            return Excel::download(new VillageExport($request->vllg), '['.Str::random(3) . '] ' . $vllg->name . '.xlsx');
        }    }
}
