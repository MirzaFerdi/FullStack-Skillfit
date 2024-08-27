<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rukun_tetangga')->insert([
            'nama' => "Mochammad Mirza Ferdinand Hakim",
            'alamat' => "Jl. Pegangsaan Timur",
            'nomor_telepon' => "081234567890",
            'email' => "admin@mail.com",
            'password' => bcrypt('password123'),
            'saldo' => 80000,
        ]);
    }
}
