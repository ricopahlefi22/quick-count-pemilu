<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Voter;
use App\Models\Witness;

class LiveSaksi extends Component
{

     public $liveSaksi;

    public function mount()
    {
        $this->loadData();
    }
    public function foo()
    {
        $this->loadData();
    }

    private function loadData(){

        $this->liveSaksi = Witness::count();



 }
    public function render()
    {
        return view('livewire.live-saksi');
    }
}
