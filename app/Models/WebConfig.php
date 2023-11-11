<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class WebConfig extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'web_config';

    protected $fillable = [
        'photo',
        'name',
        'password',
        'phone_number',
        'strict',
    ];

    protected $hidden = [
        'password',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
