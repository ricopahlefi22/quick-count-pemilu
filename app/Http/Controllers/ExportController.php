<?php

namespace App\Http\Controllers;

use App\Exports\AllExport;
use App\Exports\CoordinatorExport;
use App\Exports\CoordinatorMemberExport;
use App\Exports\DistrictExport;
use App\Exports\VillageExport;
use App\Exports\VotingPlaceExport;
use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function export(Request $request)
    {
        if ($request->tps) {
            $tps = VotingPlace::findOrFail($request->tps);

            return Excel::download(new VotingPlaceExport($request->tps), '[' . Str::random(8) . '] ' . $tps->village->name . ' - TPS ' . $tps->name . '.xlsx');
        }

        if ($request->vllg) {
            $vllg = Village::findOrFail($request->vllg);

            return Excel::download(new VillageExport($request->vllg), '[' . Str::random(3) . '] ' . $vllg->name . '.xlsx');
        }
    }

    function all()
    {
        return Excel::download(new AllExport(), '[' . Str::random(3) . '] ' . 'Seluruh Data.xlsx');
    }

    function district(Request $request)
    {
        $district = District::findOrFail(Crypt::decrypt($request->id));

        return Excel::download(new DistrictExport(Crypt::decrypt($request->id)), '[' . Str::random(3) . '] ' . $district->name . '.xlsx');
    }

    function village(Request $request)
    {
        $village = Village::findOrFail(Crypt::decrypt($request->id));

        return Excel::download(new VillageExport(Crypt::decrypt($request->id)), '[' . Str::random(3) . '] ' . $village->name . '.xlsx');
    }

    function votingPlace(Request $request)
    {
        $votingPlace = VotingPlace::findOrFail(Crypt::decrypt($request->id));

        return Excel::download(new VotingPlaceExport(Crypt::decrypt($request->id)), '[' . Str::random(3) . '] ' . $votingPlace->village->name . ' TPS ' . $votingPlace->name . '.xlsx');
    }

    function coordinatorMember(Request $request)
    {
        $coordinator = Voter::findOrFail(Crypt::decrypt($request->id));

        return Excel::download(new CoordinatorMemberExport(Crypt::decrypt($request->id)), '[' . Str::random(3) . '] Data Anggota ' . $coordinator->name . '.xlsx');
    }

    function allCoordinator()
    {
        return Excel::download(new CoordinatorExport(), '[' . Str::random(3) . '] Data Seluruh Koordinator.xlsx');
    }
}
