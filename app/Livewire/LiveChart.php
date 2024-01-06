<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Candidate;

use App\Models\VotingResult;




class LiveChart extends Component
{
    public $datas = [];

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
    $candidates = Candidate::all();
    $data = [];

    foreach ($candidates as $candidate) {
        $totalVotes = VotingResult::where('candidate_id', $candidate->id)->sum('number');
        $data[] = [
            'label' => $candidate->name,
            'data' => $totalVotes,
        ];
    }

    usort($data, fn ($a, $b) => $b['data'] - $a['data']);
    $data = array_slice($data, 0, 10);

    $this->datas = json_encode($data);
    // $this->emit('refreshChart', ['seriesData' => $data]);
}

    public function render()
    {
        return view('livewire.live-chart');
    }
}
