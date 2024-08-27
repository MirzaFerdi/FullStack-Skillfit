<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;

    protected $table = 'rumah';

    protected $fillable = [
        'alamat',
        'status_rumah',
    ];

    public function penghuni()
    {
        return $this->hasMany(Penghuni::class);
    }

    public function riwayatPenghuni()
    {
        return $this->hasMany(RiwayatPenghuni::class);
    }
}
