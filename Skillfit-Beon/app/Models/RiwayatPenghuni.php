<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghuni extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penghuni';

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'rumah_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

}
