<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function village()
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    public function votingPlace()
    {
        return $this->hasMany(VotingPlace::class, 'district_id');
    }

    public function voters(){
        return $this->hasMany(Voter::class, 'district_id');
    }
}
