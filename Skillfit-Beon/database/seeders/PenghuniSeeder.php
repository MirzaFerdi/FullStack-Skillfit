<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penghuni')->insert([
            'rumah_id' => 1,
            'nama_lengkap' => 'Budi Santoso',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567890',
            'status_menikah' => 'Belum Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 2,
            'nama_lengkap' => 'Ani Rahayu',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567891',
            'status_menikah' => 'Belum Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 3,
            'nama_lengkap' => 'Joko Susilo',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567892',
            'status_menikah' => 'Belum Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 4,
            'nama_lengkap' => 'Rina Wati',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567893',
            'status_menikah' => 'Sudah Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 4,
            'nama_lengkap' => 'Dodi Susanto',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567894',
            'status_menikah' => 'Sudah Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 5,
            'nama_lengkap' => 'Siti Rahmawati',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567895',
            'status_menikah' => 'Sudah Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 5,
            'nama_lengkap' => 'Rudi Santoso',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567896',
            'status_menikah' => 'Sudah Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 6,
            'nama_lengkap' => 'Santi Rahayu',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567897',
            'status_menikah' => 'Belum Menikah',
        ]);
        DB::table('penghuni')->insert([
            'rumah_id' => 7,
            'nama_lengkap' => 'Joni Susilo',
            'foto_ktp' => null,
            'status_penghuni' => 'Penghuni Tetap',
            'nomor_telepon' => '081234567898',
            'status_menikah' => 'Belum Menikah',
        ]);
    }
}
