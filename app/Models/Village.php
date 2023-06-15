<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'district_id',
    ];

    public function votingPlace()
    {
        return $this->hasMany(VotingPlace::class, 'village_id');
    }

    public function voters()
    {
        return $this->hasMany(Voter::class, 'village_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
