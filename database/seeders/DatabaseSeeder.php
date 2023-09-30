<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruu;
use App\Models\Content;
use App\Models\Chart;
use App\Models\Agenda;
use App\Models\Clean;
use App\Models\Komisi;
use App\Models\Bulan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Content::create([
        //     'chart_id' => 3,
        //     'dashboard' => "kelompok23

        // ]);
        // Content::create([
        //     'chart_id' => 1,
        //     'dashboard' => "kelompok23

        // ]);
        // Content::create([
        //     'chart_id' => 2,
        //     'dashboard' => "kelompok23

        // ]);
        // Content::create([
        //     'chart_id' => 7,
        //     'dashboard' => "kelompok23

        // ]);
        Content::create([
            'chart_id' => 8,
            'dashboard' => "kelompok23",
        ]);
        Chart::create([
            'name' => "Nama 1",
            'grid' => 9
        ]);
        Chart::create([
            'name' => "Nama 2",
            'grid' => 3
        ]);
        Chart::create([
            'name' => "Nama 3",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Nama 4",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Nama 5",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Nama 6",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Nama 7",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Nama 8",
            'grid' => 8
        ]);

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
            'judul' => "Jenis Kelamin",
            'keterangan' => "L",
            'jumlah' => 350,
        ]);
        Clean::create([
            'judul' => "Jenis Kelamin",
            'keterangan' => "P",
            'jumlah' => 260,
        ]);
    }
}
