<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPasswordReset extends Model
{
    use HasFactory;
    public $primaryKey  = 'phone_number';
    protected $table = 'admin_password_resets';
}
