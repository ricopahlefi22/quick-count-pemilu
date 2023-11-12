<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PartyController extends Controller
{
    function index()
    {
        $data['title'] = 'Data Partai';
        $data['parties'] = Party::all();

        return view('owner.party.index', $data);
    }

    function detail(Request $request)
    {
        $data['title'] = 'Detail Partai';
        $data['party'] = Party::findOrFail(Crypt::decrypt($request->id));

        if ($request->ajax()) {
            return DataTables::of($data['party']->candidates)
                ->addIndexColumn()
                ->addColumn('name', function (Candidate $candidate) {
                    if (empty($candidate->photo)) {
                        return '<span>' . $candidate->name . '</span>';
                    } else {
                        return '<a class="image-popup-no-margins" href="' . asset($candidate->photo) . '">
                        <img src="' . asset($candidate->photo) . '" class="avatar-sm img-thumbnail rounded-circle">
                        </a> <span>' . $candidate->name . '</span>';
                    }
                })
                ->addColumn('voting_result', function (Candidate $candidate) {
                    $totalVotingResult = 0;
                    foreach ($candidate->votingResult as $votingResult) {
                        $totalVotingResult += $votingResult->number;
                    }
                    return $totalVotingResult.' Suara';
                })
                ->addColumn('action', function (Candidate $candidate) {
                    $btn = '<button data-id="' . $candidate->id . '"  class="btn btn-sm btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                    // $btn .= '<button data-id="' . $candidate->id . '"  class="btn btn-sm btn-danger delete" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                    return '<div class="btn-group">' . $btn . '</div>';
                })
                ->rawColumns(['name', 'party', 'action'])
                ->make(true);
        }

        return view('owner.party.detail', $data);
    }
}
