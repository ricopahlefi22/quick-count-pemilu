<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use yajra\DataTables\DataTables;

class VoterController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data Pemilih';
        $data['votingPlaces'] = VotingPlace::where('village_id', Crypt::decrypt($request->id))->get();
        $data['village'] = Village::findOrFail(Crypt::decrypt($request->id));
        $data['voting_places_count'] = $data['votingPlaces']->count();
        $data['voters_count'] = Voter::where('village_id', Crypt::decrypt($request->id))->count();
        $data['districts'] = District::all();

        if (Auth::guard('owner')->check()) {
            $data['coordinators_count'] = Voter::where('level', 1)->where('village_id', Crypt::decrypt($request->id))->count();
            $data['self_voters_count'] = Voter::whereNotNull('coordinator_id')->where('village_id', Crypt::decrypt($request->id))->count();
        }

        if ($request->tps) {
            $data['voters'] = Voter::where('voting_place_id', $request->tps)->orderBy('name', 'asc')->get();
            $data['tps'] = VotingPlace::findOrFail($request->tps);

            if ($request->ajax()) {
                return DataTables::of($data['voters'])
                    ->addIndexColumn()
                    ->addColumn('family_card_number', function (Voter $voter) {
                        return empty($voter->family_card_number) ? '-' : $voter->family_card_number;
                    })
                    ->addColumn('address', function (Voter $voter) {
                        if ($voter->rt && $voter->rw) {
                            return $voter->address . ', RT ' . $voter->rt . '/RW ' . $voter->rw;
                        } else if ($voter->rt) {
                            return $voter->address . ', RT ' . $voter->rt;
                        } else {
                            return $voter->address;
                        }
                    })
                    ->addColumn('phone_number', function (Voter $voter) {
                        return empty($voter->phone_number) ? '-' : $voter->phone_number;
                    })
                    ->addColumn('coordinator_id', function (Voter $voter) {
                        if ($voter->coordinator_id == $voter->id) {
                            return 'Koordinator';
                        } else {
                            return empty($voter->coordinator_id) ? '-' : $voter->coordinator->name;
                        }
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

                        if (Auth::user()->level == true || Auth::guard('owner')->check()) {
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

            if (Auth::guard('owner')->check()) {
                return view('owner.voter.table', $data);
            }

            return view('admin.voter.table', $data);
        }

        if (Auth::guard('owner')->check()) {
            return view('owner.voter.index', $data);
        }

        return view('admin.voter.index', $data);
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
            empty($request->id_number) ? null : 'id_number' => 'required|unique:voters,id_number,NULL,id,deleted_at,NULL|min:16',
            empty($request->family_card_number) ? null : 'family_card_number' => 'min:16',
            empty($request->phone_number) ? null : 'phone_number' => 'min:10|max:14|regex:/^(08[0-9\s\-\+\(\)]*)$/',
            'address' => 'required',
            'rt' => 'min:3',
            'rw' => 'min:3',
            'district_id' => 'required',
            'village_id' => 'required',
        ], [
            'name.required' => 'kolom nama belum diisi',
            'id_number.required' => 'kolom NIK belum diisi',
            'id_number.unique' => 'NIK sudah ada',
            'id_number.min' => 'panjang NIK harus 16 karakter',
            'family_card_number.min' => 'panjang No. KK harus 16 karakter',
            'phone_number.min' => 'panjang No. Handphone minimal 10 karakter',
            'phone_number.max' => 'panjang No. Handphone maksimal 14 karakter',
            'phone_number.regex' => 'format No. Handphone tidak benar',
            'address.required' => 'isi data alamat',
            'rt.required' => 'isi kolom RT',
            'rt.min' => 'panjang nomor RT harus 3 karakter',
            'rw.required' => 'isi kolom RW',
            'rw.min' => 'panjang nomor RW harus 3 karakter',
            'district_id.required' => 'kecamatan belum dipilih',
            'village_id.required' => 'kelurahan/desa belum dipilih',
        ]);

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
