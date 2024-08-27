<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatPenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('riwayat_penghuni')->insert([
            'nama' => "Abdul Mirza",
            'nomor_telepon' => "081234567890",
            'rumah_id' => 20,
            'tanggal_masuk' => '2024-03-01',
            'tanggal_keluar' => '2024-08-20',
        ]);
    }
}
