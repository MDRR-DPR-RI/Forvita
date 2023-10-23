<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Content;
use App\Models\Cluster;
use App\Models\Dashboard;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::Create([
            'name' => 'USER 1',
            'role_id' => 1, // admin
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        User::Create([
            'name' => 'C. Ucok',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
        ]);
        User::Create([
            'name' => 'P. Asep',
            'email' => 'test3@example.com',
            'password' => bcrypt('password'),
        ]);


        Role::create([
            'name' => "Admin",
        ]);
        Role::create([
            'name' => "User",
        ]);

        Cluster::create([
            'name' => "Komisi",
        ]);

        Cluster::create([
            'name' => "Pustekinfo",
        ]);

        Permission::create([
            'user_id' => 2,
            'dashboard_id' => 1,
        ]);

        Dashboard::factory(10)->create();

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
