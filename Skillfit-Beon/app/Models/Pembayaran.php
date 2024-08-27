<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'penghuni_id',
        'iuran_id',
        'jumlah',
        'tanggal',
        'status',

    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function iuran()
    {
        return $this->belongsTo(Iuran::class);
    }
}
