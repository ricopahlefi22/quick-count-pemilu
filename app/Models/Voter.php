<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'photo',
        'name',
        'id_number',
        'family_card_number',
        'address',
        'rt',
        'rw',
        'birthplace',
        'birthday',
        'phone_number',
        'gender',
        'marital_status',
        'disability_information',
        'e_ktp_record_state',
        'e_ktp_image',
        'description',
        'level',
        'district_id',
        'village_id',
        'coordinator_id',
        'voting_place_id',
    ];

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
