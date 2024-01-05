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

class LiveVillage extends Component
{

     public $livecore;
     public $liveregis;
     public $notregis;
     public $livevot;
     public $ambilId;
     

    public function mount()
    {
        $this->ambilId = Crypt::decrypt(request()->id);
        $this->loadData($this->ambilId);
    }
    public function livevillage()
    {
        $this->loadData($this->ambilId);
    }

    public function loadData($id){


      
       
        $data = Village::findOrFail($id);

        $this->livecore = Voter::where('village_id', $data->id)->where('level', true)->count();
        $this->liveregis = Voter::where('village_id', $data->id)->whereNotNull('coordinator_id')->count();
        $this->notregis = Voter::where('village_id', $data->id)->whereNull('coordinator_id')->count();
        $this->livevot = Voter::where('village_id', $data->id)->count();


        // dd($this);


 }
    public function render()
    {
        return view('livewire.live-village');
    }
}
