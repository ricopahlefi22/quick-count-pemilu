<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Monitor;
use App\Models\Party;
use App\Models\VotingResult;
use App\Models\WebConfig;
use App\Models\Candidate;
use App\Models\Voter;


class LivePenduduk extends Component
{
    public $livePendukung;

    public function mount()
    {
        $this->loadData();
    }
    public function foo()
    {
        $this->loadData();
    }

    private function loadData(){

        $this->livePendukung = Voter::whereNotNull('coordinator_id')->count();

        // $data['self_voters_count'] = Voter::whereNotNull('coordinator_id')->count();
        // $data['coordinators_count'] = Voter::where('level', 1)->count();
        // $data['witnesses_count'] = Witness::count();
        // $data['monitors_count'] = Monitor::count();


 }
 public function render()
 {

    return view('livewire.live-penduduk');
}
}
