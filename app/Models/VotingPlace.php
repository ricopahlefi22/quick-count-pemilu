<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotingPlace extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'district_id',
        'village_id',
        'name',
        'address',
        'latitude',
        'longitude',
    ];

    public static $validationMessage = [
        'district_id.required' => 'mohon pilih kecamatan',
        'village_id.required' => 'mohon pilih kelurahan/desa',
        'name.required' => 'mohon berikan nama',
        'address.required' => 'mohon berikan alamat',
        'latitude.required' => 'mohon isi kolom latitude',
        'longitude.required' => 'mohon isi kolom longitude',
    ];

    public function witness()
    {
        return $this->hasOne(Witness::class);
    }

    public function monitor()
    {
        return $this->hasMany(Monitor::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function voters()
    {
        return $this->hasMany(Voter::class, 'voting_place_id');
    }
}
