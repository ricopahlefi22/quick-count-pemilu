<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id',
        'photo',
        'evidence_image',
        'ktp_image',
        'name',
        'id_number',
        'family_card_number',
        'phone_number',
        'age',
        'birthplace',
        'birthday',
        'gender',
        'marital_status',
        'address',
        'rt',
        'rw',
        'note',
        'level',
        'district_id',
        'village_id',
        'voting_place_id',
        'coordinator_id',
    ];

    public function monitor(){
        return $this->hasOne(Monitor::class);
    }

    public function coordinator()
    {
        return $this->belongsTo(Voter::class, 'coordinator_id');
    }

    public function member()
    {
        return $this->hasMany(Voter::class, 'coordinator_id');
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
