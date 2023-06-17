<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\DataTables\DataTables;

class CoordinatorController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Koordinator';

        if ($request->vllg) {
            $data['village'] = Village::findOrFail($request->vllg);
            $data['coordinators'] = Voter::where('level', 1)->where('village_id', $request->vllg)->get();
            if ($request->ajax()) {
                return DataTables::of($data['coordinators'])
                    ->addIndexColumn()
                    ->addColumn('family_card_number', function (Voter $coordinator) {
                        return empty($coordinator->family_card_number) ? '-' : $coordinator->family_card_number;
                    })
                    ->addColumn('address', function (Voter $coordinator) {
                        return $coordinator->address . ', RT ' . $coordinator->rt . '/RW ' . $coordinator->rw;
                    })
                    ->addColumn('phone_number', function (Voter $coordinator) {
                        return empty($coordinator->phone_number) ? '-' : $coordinator->phone_number;
                    })
                    ->addColumn('member_total', function (Voter $coordinator) {
                        return $coordinator->member->where('level', 0)->count();
                    })
                    ->addColumn('voting_place_id', function (Voter $coordinator) {
                        return empty($coordinator->voting_place_id) ? '-' : $coordinator->votingPlace->name;
                    })
                    ->addColumn('action', function (Voter $coordinator) {
                        $btn = '<a href="coordinators?id=' . $coordinator->id . '" class="dropdown-item" disabled>Detail</a> ';
                        $btn .= '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit" disabled>Edit</button> ';

                        if ($coordinator->level == 0) {
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item coordinator" disabled>' . (empty($coordinator->coordinator_id) ? 'Tambah Koordinator' : 'Ganti Koordinator') . '</button>';
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-primary be-coordinator" disabled>Jadikan Koordinator</button>';
                        } else {
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger cancel-coordinator" disabled>Batalkan Koordinator</button>';
                        }

                        if (Auth::user()->level == true) {
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger delete" disabled>Hapus Data</button>';
                        }
                        return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                            . '<div class="dropdown-menu" role="menu">'
                            . $btn
                            . '</div></div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }


            return view('admin.coordinator.table', $data);
        }

        if ($request->id) {
            $data['coordinator'] = Voter::findOrFail($request->id);
            $data['title'] = 'Detail Data ' . $data['coordinator']->name;

            return view('admin.coordinator.detail', $data);
        }

        $data['coordinator_count'] = Voter::where('level', 1)->count();
        $data['districts'] = District::all();

        return view('admin.coordinator.index', $data);
    }

    function json(Request $request)
    {
        $coordinator = Voter::where('level', 1)->where('village_id', $request->village_id)->with('votingPlace')->get();
        return response()->json($coordinator);
    }

    function checkCoordinator(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        $dataCoordinator = Voter::where('level', 1)->with(['village', 'votingPlace'])->get();

        return response()->json([
            'data' => $data,
            'list' => $dataCoordinator,
        ]);
    }

    function coordinator(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        $data->coordinator_id = $request->coordinator_id;
        $data->update();

        return response()->json($data->name . ' berhasil didaftarkan ke koordinator');
    }

    function beCoordinator(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        $data->level = 1;
        $data->coordinator_id = $data->id;
        $data->update();

        return response()->json($data->name . ' telah menjadi koordinator.');
    }

    function cancelCoordinator(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        $data->level = 0;
        $data->coordinator_id = null;
        $data->update();

        foreach ($data->member as $member) {
            $member->coordinator_id = null;
            $member->update();
        }

        return response()->json('Koordinator ' . $data->name . ' berhasil dibatalkan.');
    }
}
