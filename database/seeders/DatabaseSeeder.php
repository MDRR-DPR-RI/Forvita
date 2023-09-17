<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruu;
use App\Models\Agenda;
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
        Komisi::create([
            'name' => 'Komisi i',
        ]);
        Komisi::create([
            'name' => 'Komisi ii',
        ]);
        Komisi::create([
            'name' => 'Komisi iii',
        ]);
        Komisi::create([
            'name' => 'Komisi iv',
        ]);
        Komisi::create([
            'name' => 'Komisi v',
        ]);
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
