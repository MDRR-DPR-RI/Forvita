<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Chart;
use App\Models\Clean;

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

        Content::create([
            'chart_id' => 8,
            'dashboard' => "kelompok23",
            'judul' => 'Agama',
            'x_value' => '["Islam","Kristen","Budha"]',
            'y_value' => '[800,200,150]'
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
            'name' => "Bar Chart With AI Analyst",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Line Chart",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Donut Chart",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Card",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Table",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Side Bar Chart",
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
