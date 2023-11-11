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
        // 'age',
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

    public static $validationMessage = [
        'name.required' => 'kolom nama belum diisi',
        'id_number.required' => 'kolom NIK belum diisi',
        'id_number.unique' => 'NIK sudah ada',
        'id_number.min' => 'panjang NIK harus 16 karakter',
        'family_card_number.min' => 'panjang No. KK harus 16 karakter',
        'phone_number.min' => 'panjang No. Handphone minimal 10 karakter',
        'phone_number.max' => 'panjang No. Handphone maksimal 14 karakter',
        'phone_number.regex' => 'format No. Handphone tidak benar',
        'address.required' => 'isi data alamat',
        'rt.required' => 'isi kolom RT',
        'rt.min' => 'panjang nomor RT harus 3 karakter',
        'rw.required' => 'isi kolom RW',
        'rw.min' => 'panjang nomor RW harus 3 karakter',
        'district_id.required' => 'kecamatan belum dipilih',
        'village_id.required' => 'kelurahan/desa belum dipilih',
        'voting_place_id.required' => 'tps belum dipilih',
    ];

    public function monitor()
    {
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
