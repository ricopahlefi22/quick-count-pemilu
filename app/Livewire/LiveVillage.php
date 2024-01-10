<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Village;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LiveVillage extends Component
{
    public $coordinators_count;
    public $registered_voters_count;
    public $not_registered_voters_count;
    public $voters_count;
    public $villageId;

    public function mount(Request $request)
    {
        $this->villageId = Crypt::decrypt($request->id);
        $this->loadData($this->villageId);
    }

    public function liveVillage()
    {
        $this->loadData($this->villageId);
    }

    public function loadData($id)
    {
        $village = Village::findOrFail($id);

        $this->coordinators_count = Voter::where('village_id', $village->id)->where('level', true)->count();
        $this->registered_voters_count = Voter::where('village_id', $village->id)->whereNotNull('coordinator_id')->count();
        $this->not_registered_voters_count = Voter::where('village_id', $village->id)->whereNull('coordinator_id')->count();
        $this->voters_count = Voter::where('village_id', $village->id)->count();
    }

    public function render()
    {
        return view('livewire.live-village');
    }
}
