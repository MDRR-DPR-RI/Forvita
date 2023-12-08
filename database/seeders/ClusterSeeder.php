<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cluster;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cluster::create([
            'position' => 1,
            'user_id' => 2,
            'name' => "Komisi",
            'icon_name' => "bi bi-pie-chart",
        ]);

        Cluster::create([
            'position' => 2,
            'user_id' => 1,
            'name' => "Pustekinfo",
            'icon_name' => "bi bi-pie-chart",
        ]);
    }
}
