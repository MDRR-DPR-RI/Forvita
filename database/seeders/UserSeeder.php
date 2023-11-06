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
        User::Create([
            'name' => 'Airlangga Eka Wardhana',
            'role_id' => 1,
            'email' => 'angga@dpr.go.id',
            'password' => bcrypt('Pu$t3k1nf0'),
        ]);
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
    }
}
