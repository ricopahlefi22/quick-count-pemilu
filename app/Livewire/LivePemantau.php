<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Voter;
use App\Models\Monitor;

class LivePemantau extends Component
{

     public $livePemantau;

    public function mount()
    {
        $this->loadData();
    }
    public function foo()
    {
        $this->loadData();
    }

    private function loadData(){

        $this->livePemantau = Monitor::count();

        // $data['self_voters_count'] = Voter::whereNotNull('coordinator_id')->count();
        // $data['coordinators_count'] = Voter::where('level', 1)->count();
        // $data['witnesses_count'] = Witness::count();
        // $data['monitors_count'] = Monitor::count();


 }
    public function render()
    {
        return view('livewire.live-pemantau');
    }
}
