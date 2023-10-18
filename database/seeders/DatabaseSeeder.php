<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Content;
use App\Models\Cluster;
use App\Models\Dashboard;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::Create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Cluster::create([
            'name' => "Komisi",
        ]);

        Cluster::create([
            'name' => "Pustekinfo",
        ]);

        Dashboard::factory(5)->create();

        $this->call([
            SchedulerSeeder::class,
            ChartSeeder::class,
            CleanSeeder::class,
            PromptSeeder::class,
            // ... other seeders
        ]);

        // last create content
        Content::create([
            'chart_id' => 8,
            'dashboard_id' => 1,
            'judul' => 'Agama',
            'x_value' => '["Islam","Kristen","Budha"]',
            'y_value' => '[800,200,150]'
        ]);
    }
}
