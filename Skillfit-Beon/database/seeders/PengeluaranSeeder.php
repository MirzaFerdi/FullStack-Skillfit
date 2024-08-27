<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengeluaran')->insert([
            'keterangan' => 'Iuran Perbaikan Jalan',
            'nominal' => 100000,
            'tanggal' => '2024-01-01',
        ]);
        DB::table('pengeluaran')->insert([
            'keterangan' => 'Iuran Perbaikan Atap Masjid',
            'nominal' => 100000,
            'tanggal' => '2024-02-10',
        ]);
        DB::table('pengeluaran')->insert([
            'keterangan' => 'Iuran Pemeliharaan Taman',
            'nominal' => 50000,
            'tanggal' => '2024-03-15',
        ]);
        DB::table('pengeluaran')->insert([
            'keterangan' => 'Iuran Gaji Satpam',
            'nominal' => 250000,
            'tanggal' => '2024-04-20',
        ]);
    }
}
