<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            'penghuni_id' => 1,
            'iuran_id' => 1,
            'jumlah' => 180000,
            'tanggal' => '2024-01-01',
            'status' => 'Lunas',
        ]);
        DB::table('pembayaran')->insert([
            'penghuni_id' => 2,
            'iuran_id' => 2,
            'jumlah' => 100000,
            'tanggal' => '2024-02-10',
            'status' => 'Lunas',
        ]);
        DB::table('pembayaran')->insert([
            'penghuni_id' => 3,
            'iuran_id' => 2,
            'jumlah' => 200000,
            'tanggal' => '2024-03-15',
            'status' => 'Lunas',
        ]);
        DB::table('pembayaran')->insert([
            'penghuni_id' => 4,
            'iuran_id' => 2,
            'jumlah' => 100000,
            'tanggal' => '2024-04-20',
            'status' => 'Lunas',
        ]);
    }
}
