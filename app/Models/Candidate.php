<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'photo',
        'number',
        'name',
        'gender',
        'city',
        'party_id',
    ];

    public static $validationMessage = [
        'number.required' => 'kolom nomor urut belum diisi',
        'name.required' => 'kolom nama belum diisi',
        'gender.required' => 'pilih jenis kelamin',
        'city.required' => 'kolom kota belum diisi',
        'party_id.required' => 'pilih partai terlebih dahulu',
    ];

    public function votingResult()
    {
        return $this->hasMany(VotingResult::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
