<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LiveDistrict extends Component
{
    public $coordinators_count;
    public $registered_voters_count;
    public $not_registered_voters_count;
    public $voters_count;
    public $districtId;

    public function mount(Request $request)
    {
        $this->districtId = Crypt::decrypt($request->id);
        $this->loadData($this->districtId);
    }

    public function liveDistrict()
    {
        $this->loadData($this->districtId);
    }

    public function loadData($id)
    {
        $district = District::findOrFail($id);

        $this->coordinators_count = Voter::where('district_id', $district->id)->where('level', true)->count();
        $this->registered_voters_count = Voter::where('district_id', $district->id)->whereNotNull('coordinator_id')->count();
        $this->not_registered_voters_count = Voter::where('district_id', $district->id)->whereNull('coordinator_id')->count();
        $this->voters_count = Voter::where('district_id', $district->id)->count();
    }

    public function render()
    {
        return view('livewire.live-district');
    }
}
