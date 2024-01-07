<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LiveIndex extends Component
{

    public $coordinators_count;
    public $registered_voters_count;
    public $not_registered_voters_count;
    public $voters_count;



    public function mount()
    {

        $this->loadData();
    }
    public function liveindex()
    {
        $this->loadData();
    }

    public function loadData()
    {




        $this->coordinators_count = Voter::where('level', true)->count();
        $this->registered_voters_count = Voter::whereNotNull('coordinator_id')->count();
        $this->not_registered_voters_count = Voter::whereNull('coordinator_id')->count();
        $this->voters_count = Voter::count();


        // dd($this);


    }
    public function render()
    {
        return view('livewire.live-index');
    }
}
