<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use yajra\DataTables\DataTables;

class CoordinatorController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Koordinator';

        if ($request->vllg) {
            $data['village'] = Village::findOrFail($request->vllg);
            $data['coordinators'] = Voter::where('level', 1)->where('village_id', $request->vllg)->orderBy('voting_place_id', 'asc')->get();
            $data['districts'] = District::all();

            if ($request->ajax()) {
                return DataTables::of($data['coordinators'])
                    ->addIndexColumn()
                    ->addColumn('voting_place', function (Voter $coordinator) {
                        return $coordinator->village->name . ' (TPS ' . $coordinator->votingPlace->name . ')';
                    })
                    ->addColumn('address', function (Voter $coordinator) {
                        if ($coordinator->rt && $coordinator->rw) {
                            return $coordinator->address . ', RT ' . $coordinator->rt . '/RW ' . $coordinator->rw;
                        } else if ($coordinator->rt) {
                            return $coordinator->address . ', RT ' . $coordinator->rt;
                        } else {
                            return $coordinator->address;
                        }
                    })
                    ->addColumn('phone_number', function (Voter $coordinator) {
                        return empty($coordinator->phone_number) ? '-' : $coordinator->phone_number;
                    })
                    ->addColumn('member_total', function (Voter $coordinator) {
                        return $coordinator->member->except($coordinator->id)->count();
                    })
                    ->addColumn('action', function (Voter $coordinator) {
                        if (Auth::guard('owner')->check()) {
                            $btn = '<a href="coordinators?id=' . Crypt::encrypt($coordinator->id) . '" class="dropdown-item">Detail</a> ';
                            $btn .= '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                        } else {
                            $btn = '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                        }
                        $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';

                        if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                        }
                        return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                            . '<div class="dropdown-menu" role="menu">'
                            . $btn
                            . '</div></div>';
                    })
                    ->rawColumns([ 'address', 'phone_number', 'member_total', 'action'])
                    ->make(true);
            }

            if (Auth::guard('owner')->check()) {
                return view('owner.coordinator.table', $data);
            }

            return view('admin.coordinator.table', $data);
        }

        if ($request->id) {
            if (Auth::guard('owner')->check()) {
                $data['coordinator'] = Voter::findOrFail(Crypt::decrypt($request->id));

                if ($data['coordinator']->level != 1) {
                    return abort(404);
                }

                $data['title'] = 'Detail Data ' . $data['coordinator']->name;
                $data['members'] = Voter::where('coordinator_id', $data['coordinator']->id)->get();

                if ($request->ajax()) {
                    return DataTables::of($data['coordinator']->member->except($data['coordinator']->id))
                        ->addIndexColumn()
                        ->addColumn('voting_place', function (Voter $voter) {
                            return empty($voter->voting_place_id) ? '-' : $voter->votingPlace->name;
                        })
                        ->addColumn('village', function (Voter $voter) {
                            return empty($voter->village_id) ? '-' : $voter->village->name;
                        })
                        ->addColumn('action', function (Voter $coordinator) {
                            $btn = '<a href="coordinators?id=' . Crypt::encrypt($coordinator->id) . '" class="dropdown-item">Detail</a> ';
                            $btn .= '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';

                            if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                                $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                            }
                            return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                                . '<div class="dropdown-menu" role="menu">'
                                . $btn
                                . '</div></div>';
                        })
                        ->rawColumns(['voting_place', 'village', 'action'])
                        ->make(true);
                }

                return view('owner.coordinator.detail', $data);
            }

            return abort(404);
        }

        $data['coordinator_count'] = Voter::where('level', 1)->count();
        $data['districts'] = District::all();

        if (Auth::guard('owner')->check()) {
            return view('owner.coordinator.index', $data);
        }

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
