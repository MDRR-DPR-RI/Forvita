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
            'user_id' => 2,
            'name' => "Komisi",
        ]);

        Cluster::create([
            'user_id' => 1,
            'name' => "Pustekinfo",
        ]);
    }
}
