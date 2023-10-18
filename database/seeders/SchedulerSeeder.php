<?php

namespace Database\Seeders;

use App\Models\Scheduler;
use App\Models\Database;
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
                            select 'total_dummy_data' as judul, 'total_dummy_data_a' as keterangan, sum(a) as jumlah
                            from dataset.dummy_data
                                UNION
                            select 'total_dummy_data' as judul, 'total_dummy_data_b' as keterangan, sum(b) as jumlah
                            from dataset.dummy_data
                                UNION
                            select 'total_dummy_data' as judul, 'total_dummy_data_c' as keterangan, sum(c) as jumlah
                            from dataset.dummy_data
                            ) as query;",
        ]);
        Scheduler::create([
            'name' => "total_alasan_cuti",
            'query' => "SELECT *
                        FROM (
                        SELECT 'total_alasan_cuti' AS judul, coalesce(cuti.keterangan, 'tidak ada alasan') as keterangan, count(*) as jumlah
                        FROM db_sirajin_ppnasn.cuti as cuti
                        GROUP BY cuti.keterangan
                        ) AS query;",
        ]);
        Database::create([
            'name' => "localhost",
            'url' => "jdbc:mariadb://localhost:3306",
            'driver' => "mysql",
            'host' => "127.0.0.1",
            'port' => "3306",
            'database' => "dataset",
            'username' => "root",
            'password' => "",
        ]);
        Database::create([
            'name' => "postgre_localhost",
            'url' => "jdbc:postgresql://localhost:5432/postgres",
            'driver' => "pgsql",
            'host' => "127.0.0.1",
            'port' => "5432",
            'database' => "dummy_database",
            'username' => "postgres",
            'password' => "password",
        ]);
    }
}
