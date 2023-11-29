<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin can do everthing
        // User can only create dashboard when got permission
        // Viewer can only see the dashboard when got permission
        User::Create([
            'name' => 'Airlangga Eka Wardhana',
            'role_id' => 1, // Admin
            'email' => 'angga@dpr.go.id',
            'password' => bcrypt('Pu$t3k1nf0'),
        ]);
        User::Create([
            'name' => 'Admin',
            'role_id' => 1, // admin
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        User::Create([
            'name' => 'Test',
            'role_id' => 1, // admin
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        User::Create([
            'name' => 'P. Asep',
            'role_id' => 2, // User
            'email' => 'test3@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
