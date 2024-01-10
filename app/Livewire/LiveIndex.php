<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Voter;

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

    public function liveIndex()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->coordinators_count = Voter::where('level', true)->count();
        $this->registered_voters_count = Voter::whereNotNull('coordinator_id')->count();
        $this->not_registered_voters_count = Voter::whereNull('coordinator_id')->count();
        $this->voters_count = Voter::count();
    }

    public function render()
    {
        return view('livewire.live-index');
    }
}
