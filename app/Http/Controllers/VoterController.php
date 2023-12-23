<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use yajra\DataTables\DataTables;

class  VoterController extends Controller
{
    function village(Request $request)
    {
        $data['title'] = 'Data Pemilih';
        $data['districts'] = District::all();

        $data['village'] = Village::findOrFail(Crypt::decrypt($request->id));
        $data['voters'] = Voter::query()->where('village_id', $data['village']->id)->orderBy('name', 'asc');

        $data['coordinators_count'] = Voter::where('village_id', $data['village']->id)->where('level', true)->count();
        $data['registered_voters_count'] = Voter::where('village_id', $data['village']->id)->whereNotNull('coordinator_id')->count();
        $data['not_registered_voters_count'] = Voter::where('village_id', $data['village']->id)->whereNull('coordinator_id')->count();
        $data['voters_count'] = Voter::where('village_id', $data['village']->id)->count();

        if ($request->ajax()) {
            $datatables = new Datatables();
            return $datatables->eloquent($data['voters'])
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
                ->addColumn('age', function (Voter $voter) {
                    return empty($voter->age) ? '-' : $voter->age . ' Tahun';
                })
                ->addColumn('address', function (Voter $voter) {
                    // if ($voter->address && $voter->rt && $voter->rw) {
                    //     return $voter->address . ', RT ' . $voter->rt . '/RW ' . $voter->rw;
                    // } else if ($voter->address && $voter->rt) {
                    //     return $voter->address . ', RT ' . $voter->rt;
                    // } else if ($voter->rt && $voter->rw) {
                    //     return $voter->village->name . ', RT ' . $voter->rt . '/RW ' . $voter->rw;
                    // } else {
                    //     return empty($voter->address) ? '-' : $voter->address;
                    // }
                    $address = '';
                    if($voter->address){
                        $address = '<b>'.$voter->address . '</b><br>';
                    }
                    $defaultAddress = $voter->village->name . ', RT ' . $voter->rt . '/RW ' . $voter->rw;

                    return $address.$defaultAddress;
                })
                ->addColumn('rt', function (Voter $voter) {
                    return empty($voter->rt) ? '-' : 'RT ' . $voter->rt;
                })
                ->addColumn('rw', function (Voter $voter) {
                    return empty($voter->rw) ? '-' : 'RW ' . $voter->rw;
                })
                ->addColumn('voting_place', function (Voter $voter) {
                    return empty($voter->voting_place_id) ? '-' : '<b>TPS ' . $voter->votingPlace->name . '</b><br>' . $voter->votingPlace->village->name;
                })
                ->addColumn('phone_number', function (Voter $voter) {
                    return empty($voter->phone_number) ? '-' : $voter->phone_number;
                })
                ->addColumn('coordinator', function (Voter $voter) {
                    if ($voter->coordinator_id == $voter->id) {
                        return '<b>Koordinator</b>' . '<br>' . 'Dengan ' . $voter->member->except($voter->id)->count() . ' anggota';
                    } else {
                        return empty($voter->coordinator_id) ? '-' : '<b>' . $voter->coordinator->name . '</b>' . '<br>' . $voter->coordinator->village->name . ' TPS ' . $voter->coordinator->votingPlace->name;
                    }
                })
                ->addColumn('action', function (Voter $voter) {
                    $btn = '<a href="/voters/detail/' . Crypt::encrypt($voter->id) . '"  class="dropdown-item">Detail</a> ';
                    $btn .= '<button data-id="' . $voter->id . '"  class="dropdown-item text-warning edit">Edit</button> ';

                    if ($voter->level == 0) {
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item coordinator">' . (empty($voter->coordinator_id) ? 'Tambah Koordinator' : 'Ganti Koordinator') . '</button>';
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-primary be-coordinator">Jadikan Koordinator</button>';
                    } else {
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';
                    }

                    if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                        // $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                    }
                    return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                        . '<div class="dropdown-menu" role="menu">'
                        . $btn
                        . '</div></div>';
                })
                ->rawColumns(['name', 'address', 'voting_place', 'coordinator', 'action'])
                ->setRowClass(function (Voter $voter) {
                    if ($voter->level == 1) {
                        return 'bg-primary text-white';
                    } else if ($voter->coordinator_id) {
                        return 'bg-primary-subtle';
                    } else {
                        return 'bg-secondary-subtle';
                    }
                })
                ->toJson();
        }

        if (Auth::guard('owner')->check()) {
            return view('owner.voter.village', $data);
        }

        return view('admin.voter.village', $data);
    }

    function detail(Request $request)
    {
        $data['voter'] = Voter::findOrFail(Crypt::decrypt($request->id));
        $data['title'] = 'Detail Data ' . $data['voter']->name;
        $data['districts'] = District::all();

        if ($request->ajax()) {
            return DataTables::of($data['voter']->member->except($data['voter']->id))
                ->addIndexColumn()
                ->addColumn('age', function (Voter $voter) {
                    return empty($voter->age) ? '-' : $voter->age;
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
                ->addColumn('phone_number', function (Voter $voter) {
                    return empty($voter->phone_number) ? '-' : $voter->phone_number;
                })
                ->addColumn('voting_place', function (Voter $voter) {
                    return empty($voter->voting_place_id) ? '-' : $voter->votingPlace->name . '<br><strong>' . $voter->village->name . '</strong>';
                })
                ->addColumn('action', function (Voter $voter) {
                    $btn = '<a href="/voters/detail/' . Crypt::encrypt($voter->id) . '"  class="dropdown-item">Detail</a> ';
                    $btn .= '<button data-id="' . $voter->id . '"  class="dropdown-item text-warning edit">Edit</button> ';

                    if ($voter->level == 0) {
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item coordinator">' . (empty($voter->coordinator_id) ? 'Tambah Koordinator' : 'Ganti Koordinator') . '</button>';
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-primary be-coordinator">Jadikan Koordinator</button>';
                    } else {
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger cancel-coordinator">Batalkan Koordinator</button>';
                    }

                    if (Auth::user()->level == true || Auth::guard('owner')->check()) {
                        $btn .= '<button data-id="' . $voter->id . '" class="dropdown-item text-danger delete">Hapus Data</button>';
                    }
                    return '<div class="btn-group dropup"><button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>'
                        . '<div class="dropdown-menu" role="menu">'
                        . $btn
                        . '</div></div>';
                })
                ->rawColumns(['voting_place', 'action'])
                ->make(true);
        }

        return view('owner.voter.detail', $data);
    }

    function store(Request $request)
    {
        $request->merge([
            'id_number' => str_replace(array(' ', '_'), '', $request->id_number),
            'family_card_number' => str_replace(array(' ', '_'), '', $request->family_card_number),
            'rt' => str_replace(array(' ', '_'), '', $request->rt),
            'rw' => str_replace(array(' ', '_'), '', $request->rw),
        ]);

        $request->validate([
            'name' => 'required',
            'id_number' => empty($request->id_number) ? 'max:16' : ($request->old_id_number == $request->id_number ? 'unique:voters,id_number,' . $request->id . ',id,deleted_at,NULL|min:16' : 'unique:voters,id_number,NULL,id,deleted_at,NULL|min:16'),
            empty($request->family_card_number) ? null : 'family_card_number' => 'min:16',
            empty($request->phone_number) ? null : 'phone_number' => 'min:10|max:14|regex:/^(08[0-9\s\-\+\(\)]*)$/',
            'address' => 'required',
            'rt' => 'min:3',
            'rw' => 'min:3',
            'district_id' => 'required',
            'village_id' => 'required',
            'voting_place_id' => 'required',
        ], Voter::$validationMessage);

        $photo = $request->hidden_photo;

        if ($request->file('photo')) {
            $path = 'public/voter-photos/';
            $file = $request->file('photo');
            $file_name = $request->id_number . '-[' . time() . '].' . $file->getClientOriginalExtension();

            $file->storeAs($path, $file_name);
            $photo = "storage/voter-photos/" . $file_name;
        }

        $ktp = $request->hidden_ktp;

        if ($request->file('ktp')) {
            $path = 'public/voter-ktp/';
            $file = $request->file('ktp');
            $file_name = $request->id_number . '-[' . time() . '].' . $file->getClientOriginalExtension();

            $file->storeAs($path, $file_name);
            $ktp = "storage/voter-ktp/" . $file_name;
        }

        $evidence = $request->hidden_evidence;

        if ($request->file('evidence')) {
            $path = 'public/voter-evidence/';
            $file = $request->file('evidence');
            $file_name = $request->id_number . '-[' . time() . '].' . $file->getClientOriginalExtension();

            $file->storeAs($path, $file_name);
            $evidence = "storage/voter-evidence/" . $file_name;
        }

        $data = Voter::updateOrCreate([
            'id' => $request->id,
        ], [
            'photo' => $photo,
            'evidence_image' => $evidence,
            'ktp_image' => $ktp,
            'name' => ucwords(strtolower($request->name)),
            'id_number' => str_replace(' ', '', $request->id_number),
            'family_card_number' => str_replace(' ', '', $request->family_card_number),
            'phone_number' => str_replace('-', '', $request->phone_number),
            'birthplace' => ucwords(strtolower($request->birthplace)),
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'address' => ucwords(strtolower($request->address)),
            'rt' => $request->rt,
            'rw' => $request->rw,
            'note' => $request->note,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'voting_place_id' => $request->voting_place_id,
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
        $data = Voter::findOrFail($request->id);

        return response()->json($data);
    }

    function destroy(Request $request)
    {
        $data = Voter::findOrFail($request->id);
        foreach ($data->member as $member) {
            $member->coordinator_id = null;
            $member->update();
        }
        $data->delete();

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data telah dihapus.',
        ]);
    }
}
