<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VotingPlaceController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Tempat Pemungutan Suara';
        $data['districts'] = District::all();

        if ($request->ajax()) {
            return DataTables::of(VotingPlace::all())
                ->addIndexColumn()
                ->addColumn('voting_place', function (VotingPlace $votingPlace) {
                    return $votingPlace->village->name . ' <strong>(TPS ' . $votingPlace->name . ')</strong>';
                })
                ->addColumn('district', function (VotingPlace $votingPlace) {
                    return $votingPlace->district->name;
                })
                ->addColumn('address', function (VotingPlace $votingPlace) {
                    return empty($votingPlace->address) ? '-' : $votingPlace->address;
                })
                ->addColumn('coordinate', function (VotingPlace $votingPlace) {
                    return empty($votingPlace->latitude) ? '-' : '( ' . $votingPlace->latitude . ', ' . $votingPlace->longitude . ' )';
                })
                ->addColumn('action', function (VotingPlace $votingplace) {
                    $btn = '<button data-id="' . $votingplace->id . '"  class="btn btn-sm btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                    $btn .= '<button data-id="' . $votingplace->id . '"  class="btn btn-sm btn-danger delete" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                    return '<div class="btn-group">' . $btn . '</div>';
                })
                ->rawColumns(['voting_place', 'action'])
                ->make(true);
        }

        return view('owner.voting-place.index', $data);
    }

    function json(Request $request)
    {
        $votingPlace = VotingPlace::where('village_id', $request->village_id)->get();
        return response()->json($votingPlace);
    }

    function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'village_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], VotingPlace::$validationMessage);

        $data = VotingPlace::updateOrCreate([
            'id' => $request->id,
        ], [
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'name' => $request->name,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
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
        $data = VotingPlace::findOrFail($request->id);

        return response()->json($data);
    }

    function destroy(Request $request)
    {
        $data = VotingPlace::findOrFail($request->id);
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data telah dihapus dari sistem.',
        ]);
    }
}
