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
        $data['coordinator_count'] = Voter::where('level', 1)->count();
        $data['districts'] = District::all();

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
                            $btn = '<a href="voters?id=' . Crypt::encrypt($coordinator->id) . '" class="dropdown-item">Detail</a> ';
                            $btn .= '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                            $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';

                            if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                                // $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
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


        if (Auth::guard('owner')->check()) {
            return view('owner.coordinator.index', $data);
        }

        return view('admin.coordinator.index', $data);
    }

    function village(Request $request)
    {
        $data['village'] = Village::findOrFail(Crypt::decrypt($request->id));
        $data['title'] = 'Data Koordinator di ' . $data['village']->name;
        $data['coordinators'] = Voter::where('level', 1)->where('village_id', $data['village']->id)->orderBy('voting_place_id', 'asc')->get();
        $data['districts'] = District::all();

        if ($request->ajax()) {
            return DataTables::of($data['coordinators'])
                ->addIndexColumn()
                ->addColumn('name', function (Voter $voter) {
                    if ($voter->gender == 'P') {
                        $gender = ' <i class="fa fa-venus text-danger" title="Perempuan"></i>';
                    } else {
                        $gender = ($voter->level == true) ? ' <i class="fa fa-mars text-white" title="Laki-Laki"></i>' : ' <i class="fa fa-mars text-primary" title="Laki-Laki"></i>';
                    }
                    $id_number = empty($voter->id_number) ? null : '<br> NIK. ' . $voter->id_number;
                    return $voter->name . $gender . $id_number;
                })
                ->addColumn('voting_place', function (Voter $coordinator) {
                    return 'TPS ' . $coordinator->votingPlace->name . ' ' . $coordinator->village->name;
                })
                ->addColumn('address', function (Voter $voter) {
                    if ($voter->address && $voter->rt && $voter->rw) {
                        return $voter->address . ', RT ' . $voter->rt . '/RW ' . $voter->rw;
                    } else if ($voter->address && $voter->rt) {
                        return $voter->address . ', RT ' . $voter->rt;
                    } else if ($voter->rt && $voter->rw) {
                        return 'RT ' . $voter->rt . '/RW ' . $voter->rw;
                    } else {
                        return $voter->address;
                    }
                })
                ->addColumn('phone_number', function (Voter $coordinator) {
                    return empty($coordinator->phone_number) ? '-' : $coordinator->phone_number;
                })
                ->addColumn('member_total', function (Voter $coordinator) {
                    return $coordinator->member->except($coordinator->id)->count() . " Orang";
                })
                ->addColumn('action', function (Voter $coordinator) {
                    if (Auth::guard('owner')->check()) {
                        $btn = '<a href="/coordinators/detail/' . Crypt::encrypt($coordinator->id) . '" class="dropdown-item">Detail</a> ';
                        $btn .= '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                    } else {
                        $btn = '<button data-id="' . $coordinator->id . '"  class="dropdown-item text-warning edit">Edit</button> ';
                    }
                    $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';

                    if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                        // $btn .= '<button data-id="' . $coordinator->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                    }
                    return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                        . '<div class="dropdown-menu" role="menu">'
                        . $btn
                        . '</div></div>';
                })
                ->rawColumns(['name', 'address', 'phone_number', 'member_total', 'action'])
                ->make(true);
        }

        if (Auth::guard('owner')->check()) {
            return view('owner.coordinator.table', $data);
        }

        return view('admin.coordinator.table', $data);
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

    function deleteMember(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        $data->coordinator_id = null;
        $data->update();

        return response()->json($data->name . ' telah dikeluarkan.');
    }
}
