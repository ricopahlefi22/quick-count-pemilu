<?php

namespace App\Livewire;

use Livewire\Component;
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

    private function loadData()
    {

        $this->livePemantau = Monitor::count();
    }

    public function render()
    {
        return view('livewire.live-pemantau');
    }
}
