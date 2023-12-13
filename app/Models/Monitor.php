<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'village_id',
        'voting_place_id',
        'voter_id',
    ];

    public function voter()
    {
        return $this->belongsTo(Voter::class, 'voter_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function votingPlace()
    {
        return $this->belongsTo(VotingPlace::class, 'voting_place_id');
    }
}
