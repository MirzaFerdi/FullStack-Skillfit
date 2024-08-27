<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 1',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 2',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 3',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 4',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 5',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 6',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 7',
            'status_rumah' => 'Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 8',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 9',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 10',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 11',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 12',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 13',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 14',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 15',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 16',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 17',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 18',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 19',
            'status_rumah' => 'Belum Dihuni',
        ]);
        DB::table('rumah')->insert([
            'alamat' => 'Jl. Merdeka No. 20',
            'status_rumah' => 'Belum Dihuni',
        ]);
    }
}
