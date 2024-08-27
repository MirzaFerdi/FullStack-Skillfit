<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class RukunTetangga extends Authenticatable
{
    use Notifiable;

    protected $table = 'rukun_tetangga';

    protected $fillable = [
        'nama',
        'alamat',
        'nomor_telepon',
        'email',
        'password',
        'saldo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
