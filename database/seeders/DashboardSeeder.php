<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dashboard;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dashboard::create([
            'cluster_id' => 1,
            'name' => "Dashboard-contoh",
            'description' => "Deskripsi das-contoh",
            'icon_name' => 'bi bi-pie-chart'
        ]);
        Dashboard::create([
            'cluster_id' => 1,
            'name' => "Dashboard-embed-tableau",
            'description' => "Deskripsi das-embed-tableau",
            'icon_name' => 'bi bi-pie-chart'
        ]);
        Dashboard::factory(10)->create();
    }
}
