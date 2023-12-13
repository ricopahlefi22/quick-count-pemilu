<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\VotingPlace;
use App\Models\Witness;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WitnessController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Saksi';
        $data['votingPlaces'] = VotingPlace::all();

        if ($request->ajax()) {
            return DataTables::of(Witness::all())
                ->addIndexColumn()
                ->addColumn('voter', function (Witness $witness) {
                    return $witness->voter->name;
                })
                ->addColumn('voting_place', function (Witness $witness) {
                    return $witness->village->name . ' (TPS ' . $witness->votingPlace->name . ')';
                })
                ->addColumn('district', function (Witness $witness) {
                    return $witness->district->name;
                })
                ->addColumn('action', function (Witness $witness) {
                    $btn = '<button data-id="' . $witness->id . '"  class="btn btn-sm btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                    $btn .= '<button data-id="' . $witness->id . '"  class="btn btn-sm btn-danger delete" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                    return '<div class="btn-group">' . $btn . '</div>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('owner.witness.index', $data);
    }

    function store(Request $request)
    {
        $votingPlace = VotingPlace::findOrFail($request->voting_place_id);

        $data = Witness::updateOrCreate([
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
        $data = Witness::findOrFail($request->id);

        return response()->json($data);
    }

    function votingPlaces(Request $request)
    {
        if ($request->id) {
            $data = VotingPlace::with('village')->get();
        } else {
            $data = VotingPlace::with('village')->doesntHave('witness')->get();
        }

        return response()->json($data);
    }

    function voters(Request $request)
    {
        $data = Voter::where('voting_place_id', $request->id)->get();

        return response()->json($data);
    }

    function destroy(Request $request)
    {
        $data = Witness::findOrFail($request->id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data telah dihapus dari sistem.',
        ]);
    }
}
