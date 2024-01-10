<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LiveVotingPlace extends Component
{
    public $coordinators_count;
    public $registered_voters_count;
    public $not_registered_voters_count;
    public $voters_count;
    public $votingPlaceId;

    public function mount(Request $request)
    {
        $this->votingPlaceId = Crypt::decrypt($request->id);
        $this->loadData($this->votingPlaceId);
    }

    public function liveVotingPlace()
    {
        $this->loadData($this->votingPlaceId);
    }

    public function loadData($id)
    {
        $votingPlace = VotingPlace::findOrFail($id);

        $this->coordinators_count = Voter::where('voting_place_id', $votingPlace->id)->where('level', true)->count();
        $this->registered_voters_count = Voter::where('voting_place_id', $votingPlace->id)->whereNotNull('coordinator_id')->count();
        $this->not_registered_voters_count = Voter::where('voting_place_id', $votingPlace->id)->whereNull('coordinator_id')->count();
        $this->voters_count = Voter::where('voting_place_id', $votingPlace->id)->count();
    }

    public function render()
    {
        return view('livewire.live-voting-place');
    }
}
