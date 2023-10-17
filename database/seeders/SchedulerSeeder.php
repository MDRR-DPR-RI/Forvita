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
                VALUES
                    (null, 1, 5, 10, null, null),
                    (null, 5, 10, 1, null, null),
                    (null, 10, 1, 5, null, null);";
        DB::insert($sql);
        Scheduler::create([
            'name' => "total_dummy_data",
            'query' => "select 'total_dummy_data' as judul, 'total_dummy_data_a' as keterangan, sum(a) as data
                        from dataset.dummy_data
                            UNION
                        select 'total_dummy_data' as judul, 'total_dummy_data_b' as keterangan, sum(b) as data
                        from dataset.dummy_data
                            UNION
                        select 'total_dummy_data' as judul, 'total_dummy_data_c' as keterangan, sum(c) as data
                        from dataset.dummy_data;",
        ]);
    }
}
