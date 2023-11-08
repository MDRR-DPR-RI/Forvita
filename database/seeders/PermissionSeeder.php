<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'user_id' => 3,
            'dashboard_id' => 1,
        ]);
        Permission::create([
            'user_id' => 3,
            'dashboard_id' => 2,
        ]);
        Permission::create([
            'user_id' => 4,
            'dashboard_id' => 1,
        ]);
        Permission::create([
            'user_id' => 4,
            'dashboard_id' => 2,
        ]);
    }
}
