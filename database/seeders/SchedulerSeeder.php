<?php

namespace Database\Seeders;

use App\Models\Scheduler;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "INSERT INTO dataset.dummy_data
                VALUES ";
        for ($i = 1; $i <= 50; $i++) {
            $random_a = rand(1, 100);
            $random_b = rand(1, 100);
            $random_c = rand(1, 100);
            $sql = $sql . "(null, $random_a, $random_b, $random_c, null, null),\n";
        }
        $sql = substr($sql, 0, -2) . ";";
        echo $sql;
        DB::insert($sql);
        Scheduler::create([
            'name' => "total_dummy_data",
            'query' => "SELECT *
                        FROM (
                            select 'total_dummy_data' as judul, 'total_dummy_data_a' as keterangan, sum(a) as data
                            from dataset.dummy_data
                                UNION
                            select 'total_dummy_data' as judul, 'total_dummy_data_b' as keterangan, sum(b) as data
                            from dataset.dummy_data
                                UNION
                            select 'total_dummy_data' as judul, 'total_dummy_data_c' as keterangan, sum(c) as data
                            from dataset.dummy_data
                                            ) as query;",
        ]);
    }
}
