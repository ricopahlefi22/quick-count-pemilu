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

class LiveFooter extends Component
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
    public function livevoot()
    {
        $this->loadData($this->ambilId);
    }

    public function loadData($id){


      
       
        $data = District::findOrFail($id);

        $this->livecore = Voter::where('district_id', $data->id)->where('level', true)->count();
        $this->liveregis = Voter::where('district_id', $data->id)->whereNotNull('coordinator_id')->count();
        $this->notregis = Voter::where('district_id', $data->id)->whereNull('coordinator_id')->count();
        $this->livevot = Voter::where('district_id', $data->id)->count();


        // dd($this);


 }
    public function render()
    {
        return view('livewire.live-footer');
    }
}
