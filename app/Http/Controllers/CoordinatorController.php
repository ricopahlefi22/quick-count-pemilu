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
                    ->addColumn('family_card_number', function (Voter $voter) {
                        return empty($voter->family_card_number) ? '-' : $voter->family_card_number;
                    })
                    ->addColumn('address', function (Voter $voter) {
                        return $voter->address . ', RT ' . $voter->rt . '/RW ' . $voter->rw;
                    })
                    ->addColumn('phone_number', function (Voter $voter) {
                        return empty($voter->phone_number) ? '-' : $voter->phone_number;
                    })
                    ->addColumn('coordinator_id', function (Voter $voter) {
                        return empty($voter->coordinator_id) ? '-' : $voter->coordinator->name;
                    })
                    ->addColumn('voting_place_id', function (Voter $voter) {
                        return empty($voter->voting_place_id) ? '-' : $voter->votingPlace->name;
                    })
                    ->addColumn('action', function (Voter $voter) {
                        $btn = '<button data-id="' . $voter->id . '"  class="dropdown-item text-warning edit">Edit</button> ';

                        if ($voter->level == 0) {
                            $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item coordinator">' . (empty($voter->coordinator_id) ? 'Tambah Koordinator' : 'Ganti Koordinator') . '</button>';
                            $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-primary be-coordinator">Jadikan Koordinator</button>';
                        } else {
                            $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';
                        }

                        if (Auth::user()->level == true) {
                            $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                        }
                        return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                            . '<div class="dropdown-menu" role="menu">'
                            . $btn
                            . '</div></div>';
                    })
                    ->rawColumns(['action'])
                    ->setRowClass(function (Voter $voter) {
                        if ($voter->level == 1) {
                            return 'bg-primary text-white';
                        } else if ($voter->coordinator_id) {
                            return 'bg-primary-subtle';
                        } else {
                            return 'bg-secondary-subtle';
                        }
                    })
                    ->make(true);
            }
            return view('admin.coordinator.table', $data);
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
