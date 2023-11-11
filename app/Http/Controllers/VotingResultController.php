<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\District;
use App\Models\Party;
use App\Models\VotingPlace;
use App\Models\VotingResult;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class VotingResultController extends Controller
{
    function inputIndex(Request $request)
    {
        $data['title'] = 'Data Hasil Perolehan Suara (C1)';

        if ($request->ajax()) {
            return DataTables::of(VotingPlace::all())
                ->addIndexColumn()
                ->addColumn('voting_place', function (VotingPlace $votingPlace) {
                    return $votingPlace->village->name . ' <strong>(TPS ' . $votingPlace->name . ')</strong>';
                })
                ->addColumn('district', function (VotingPlace $votingPlace) {
                    return $votingPlace->district->name;
                })
                ->addColumn('file', function (VotingPlace $votingPlace) {
                    return empty($votingPlace->voting_result_file) ? '-' : '<a href="' . $votingPlace->voting_result_file . '" class="btn btn-sm btn-secondary" target="_blank"><i class="fa fa-file"></i> Lihat C1</a>';
                })
                ->addColumn('action', function (VotingPlace $votingPlace) {
                    if ($votingPlace->votingResult()->exists()) {
                        return '<a href="input-voting-results/' . Crypt::encrypt($votingPlace->id) . '"  class="btn btn-sm btn-dark">Perbarui C1 <i class="fa fa-arrow-alt-circle-right"></i></a> ';
                    } else {
                        return '<a href="input-voting-results/' . Crypt::encrypt($votingPlace->id) . '"  class="btn btn-sm btn-primary">Input C1 <i class="fa fa-arrow-alt-circle-right"></i></a> ';
                    }
                })
                ->rawColumns(['voting_place', 'file', 'action'])
                ->make(true);
        }

        return view('owner.input-voting-result.index', $data);
    }

    function inputVotingPlace(Request $request)
    {
        $data['title'] = 'Data Hasil Perolehan Suara (C1)';
        $data['votingPlace'] = VotingPlace::findOrFail(Crypt::decrypt($request->id));
        $data['own_parties'] = Party::where('id', WebConfig::first()->party_id)->get();
        $data['other_parties'] = Party::whereHas('candidates')->get()->except(WebConfig::first()->party_id);
        $data['parties'] = $data['own_parties']->merge($data['other_parties']);

        return view('owner.input-voting-result.input-c1', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'voting_place_id' => 'required',
        ]);

        $candidates = Candidate::all();

        $file = $request->hidden_file;

        if ($request->file('file')) {
            $path = 'public/voting-result-file/';
            $file = $request->file('file');
            $file_name = $request->voting_place_id . '-[' . time() . '].' . $file->getClientOriginalExtension();

            $file->storeAs($path, $file_name);
            $file = "storage/voting-result-file/" . $file_name;
        }

        $votingPlace = VotingPlace::findOrFail($request->voting_place_id);
        $votingPlace->voting_result_file = $file;
        $votingPlace->save();

        foreach ($candidates as $candidate) {
            $votingResult = VotingResult::where('candidate_id', $candidate->id)->where('voting_place_id', $request->voting_place_id)->first();
            if ($votingResult) {
                $votingResult->number = $request->{"number_voters_candidate_" . $candidate->id};
                $votingResult->save();
            } else {
                $data = new VotingResult;
                $data->voting_place_id = $request->voting_place_id;
                $data->party_id = $candidate->party->id;
                $data->candidate_id = $candidate->id;
                $data->number = $request->{"number_voters_candidate_" . $candidate->id};
                $data->save();
            }
        }

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data perolehan suara berhasil disimpan.',
        ]);
    }
}
