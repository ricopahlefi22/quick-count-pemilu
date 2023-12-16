<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingResult;
use App\Models\WebConfig;
use App\Models\Candidate;
use App\Models\Party;

class TvController extends Controller
{
    function tv(){

        $webConfig = WebConfig::first(); // Assuming you want to get the first WebConfig record
        $candidateId = $webConfig->candidate_id ?? null;
        $partyId = $webConfig->party_id  ?? null;

        if($candidateId){
            $candidate = Candidate::where('id', $candidateId)->get();
            $countCandidate = VotingResult::where('candidate_id', $candidateId)
                            ->groupBy('candidate_id')
                            ->selectRaw('SUM(number) as CountCandidate')
                            ->get();

            $party = Party::where('id', $partyId)->get();
            $partyCount = Candidate::where('party_id', $partyId)
                            ->groupBy('party_id')
                            ->selectRaw('SUM(number) as CountParty')
                            ->get();


        }


        // return([
        //     "Candidate" => $candidate,
        //     "Count Candidate" => $countCandidate,
        //     "Party" => $party ,
        //     "Count Party" => $partyCount,
        // ]);
        return view('livewire.show-tv');
    }
}
