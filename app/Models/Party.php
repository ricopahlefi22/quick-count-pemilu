<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use SoftDeletes, HasFactory;

    public function votingResult()
    {
        return $this->hasMany(VotingResult::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
