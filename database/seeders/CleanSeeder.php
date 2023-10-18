<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clean;

class CleanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clean::create([
            'judul' => "Agama",
            'keterangan' => "Islam",
            'jumlah' => 800,
        ]);
        Clean::create([
            'judul' => "Agama",
            'keterangan' => "Kristen",
            'jumlah' => 200,
        ]);
        Clean::create([
            'judul' => "Agama",
            'keterangan' => "Budha",
            'jumlah' => 150,
        ]);
        Clean::create([
            'judul' => "Agama",
            'keterangan' => "Hindu",
            'jumlah' => 235,
        ]);
        Clean::create([
            'judul' => "Agama",
            'keterangan' => "Konghucu",
            'jumlah' => 100,
        ]);
        Clean::create([
            'judul' => "Jenis Kelamin",
            'keterangan' => "L",
            'jumlah' => 350,
        ]);
        Clean::create([
            'judul' => "Jenis Kelamin",
            'keterangan' => "P",
            'jumlah' => 260,
        ]);
        Clean::create([
            'judul' => "Tubuh",
            'keterangan' => "Hidung",
            'jumlah' => 1,
        ]);
        Clean::create([
            'judul' => "Tubuh",
            'keterangan' => "Tangan",
            'jumlah' => 2,
        ]);
    }
}
