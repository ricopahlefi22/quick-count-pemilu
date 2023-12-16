<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Monitor;
use App\Models\Party;
use App\Models\VotingResult;
use App\Models\WebConfig;
use App\Models\Candidate;


class ShowTv extends Component
{
    public $listData;

    public function mount()
    {
        $this->loadData();
    }
    public function foo()
    {
        $this->loadData();
    }

    private function loadData()
    {

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
            $countParty = Candidate::where('party_id', $partyId)
                            ->groupBy('party_id')
                            ->selectRaw('SUM(number) as CountParty')
                            ->get();
            
           $this->listData = [
                'candidate' => $candidate,
                'countCandidate' => $countCandidate,
                'party' => $party,
                'countPary' => $countParty,
           ];
           
        }
        // $webConfig = WebConfig::first(); // Assuming you want to get the first WebConfig record
        // $candidateId = $webConfig->candidate_id ?? null;

       
        // if ($candidateId) {
        //     $listCandidate =  VotingResult::where('candidate_id', $candidateId)
        //     ->groupBy('candidate_id')
        //     ->selectRaw('candidate_id, SUM(number) as total_votes')
        //     ->get();

        //         // ->map(function ($result) {
        //         //     $candidate = $result->candidate;
        //         //     $partyId = $candidate->party_id;
        //         //     $listParty = Party::where('id', $partyId)->get();
        //         //     return [
        //         //         "Candidate" => $candidate->name,
        //         //         "Party" => $listParty,
        //         //     ];
        //         // });
        //     // $this->listCandidate = $listCandidate;
        //     dd($listCandidate);

           
        // }
       
    }
    public function render()
    {
       
        return view('livewire.show-tv');
    }
}