<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('iuran')->insert([
            'jenis_iuran' => "Iuran Kebersihan",
            'nominal' => 15000,
        ]);
        DB::table('iuran')->insert([
            'jenis_iuran' => "Iuran Satpam",
            'nominal' => 100000,
        ]);
    }
}
