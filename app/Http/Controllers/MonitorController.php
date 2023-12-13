<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonitorController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Pemantau';
        $data['votingPlaces'] = VotingPlace::all();

        if ($request->ajax()) {
            return DataTables::of(Monitor::all())
                ->addIndexColumn()
                ->addColumn('voter', function (Monitor $witness) {
                    return $witness->voter->name;
                })
                ->addColumn('voting_place', function (Monitor $witness) {
                    return $witness->village->name . ' (TPS ' . $witness->votingPlace->name . ')';
                })
                ->addColumn('district', function (Monitor $witness) {
                    return $witness->district->name;
                })
                ->addColumn('action', function (Monitor $witness) {
                    $btn = '<button data-id="' . $witness->id . '"  class="btn btn-sm btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                    $btn .= '<button data-id="' . $witness->id . '"  class="btn btn-sm btn-danger delete" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                    return '<div class="btn-group">' . $btn . '</div>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('owner.monitor.index', $data);
    }

    function store(Request $request)
    {
        $votingPlace = VotingPlace::findOrFail($request->voting_place_id);

        $data = Monitor::updateOrCreate([
            'id' => $request->id,
        ], [
            'district_id' => $votingPlace->district_id,
            'village_id' => $votingPlace->village_id,
            'voting_place_id' => $votingPlace->id,
            'voter_id' => $request->voter_id,
        ]);

        if ($request->id != $data->id) {
            return response()->json([
                'code' => 200,
                'status' => 'Berhasil!',
                'message' => 'Data telah ditambahkan',
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'status' => 'Berhasil!',
                'message' => 'Data telah diperbaharui.',
            ]);
        }
    }

    function check(Request $request)
    {
        $data = Monitor::findOrFail($request->id);

        return response()->json($data);
    }

    function votingPlaces()
    {
        $data = VotingPlace::with('village')->get();

        return response()->json($data);
    }

    function voters(Request $request)
    {
        if ($request->monitor_id) {
            $dataDoesntHaveMonitor = Voter::where('voting_place_id', $request->id)->doesntHave('monitor')->get();

            $data = $dataDoesntHaveMonitor->merge(Voter::where('id', $request->monitor_id)->get());
        } else {
            $data = Voter::where('voting_place_id', $request->id)->doesntHave('monitor')->get();
        }

        return response()->json($data);
    }

    function destroy(Request $request)
    {
        $data = Monitor::findOrFail($request->id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data telah dihapus dari sistem.',
        ]);
    }
}
