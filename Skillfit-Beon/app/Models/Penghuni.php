<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $table = 'penghuni';

    protected $fillable = [
        'rumah_id',
        'nama_lengkap',
        'foto_ktp',
        'status_penghuni',
        'nomor_telepon',
        'status_menikah',
    ];

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }


}
