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

        Ruu::factory(20)->create();
        Agenda::factory(20)->create();
        // Content::create([
        //     'chart_id' => 3,
        // ]);
        // Content::create([
        //     'chart_id' => 1,
        // ]);
        // Content::create([
        //     'chart_id' => 2,
        // ]);
        // Content::create([
        //     'chart_id' => 7,
        // ]);
        Content::create([
            'chart_id' => 8,
        ]);
        Chart::create([
            'name' => "Nama 1",
        ]);
        Chart::create([
            'name' => "Nama 2",
        ]);
        Chart::create([
            'name' => "Nama 3",
        ]);
        Chart::create([
            'name' => "Nama 4",
        ]);
        Chart::create([
            'name' => "Nama 5",
        ]);
        Chart::create([
            'name' => "Nama 6",
        ]);
        Chart::create([
            'name' => "Nama 7",
        ]);
        Chart::create([
            'name' => "Nama 8",
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










        // Komisi::create([
        //     'name' => 'Komisi I',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi II',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi III',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi IV',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi V',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi VI',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi VII',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi VIII',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi IX',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi X',
        // ]);
        // Komisi::create([
        //     'name' => 'Komisi XI',
        // ]);
        //     Bulan::create([
        //         'name' => 'Jan',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Feb',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Mar',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Apr',
        //     ]);
        //     Bulan::create([
        //         'name' => 'May',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Jun',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Jul',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Aug',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Sep',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Okt',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Nov',
        //     ]);
        //     Bulan::create([
        //         'name' => 'Des',
        //     ]);
    }
}
