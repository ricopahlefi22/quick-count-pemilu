<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;
use App\Models\VotingResult;

class LiveChart extends Component
{
    public $candidates;

    public function mount()
    {
        $this->loadData();
    }

    public function liveFoo()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $candidates = Candidate::all();
        $data = [];

        foreach ($candidates as $candidate) {
            $totalVotes = VotingResult::where('candidate_id', $candidate->id)->sum('number');
            $data[] = [
                'name' => $candidate->name,
                'party_logo' => $candidate->party->logo,
                'total_votes' => $totalVotes,
            ];
        }

        usort($data, fn ($a, $b) => $b['total_votes'] - $a['total_votes']);
        $this->candidates = array_slice($data, 0, 10);
    }

    public function render()
    {
        return view('livewire.live-chart');
    }
}
