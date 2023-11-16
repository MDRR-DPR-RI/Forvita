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
        $sql = "INSERT INTO dummy_data
                VALUES ";
        for ($i = 1; $i <= 50; $i++) {
            $random_a = rand(1, 100);
            $random_b = rand(1, 100);
            $random_c = rand(1, 100);
            $sql = $sql . "(null, $random_a, $random_b, $random_c, null, null),\n";
        }
        $sql = substr($sql, 0, -2) . ";";
        DB::insert($sql);
        Scheduler::create([
            'name' => "total_dummy_data",
            'query' => "SELECT *
                        FROM (
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'a' as 'keterangan', sum(a) as 'jumlah'
                            from dummy_data
                            UNION
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'b' as 'keterangan', sum(b) as 'jumlah'
                            from dummy_data
                            UNION
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'c' as 'keterangan', sum(c) as 'jumlah'
                            from dummy_data
                        ) as query;",
        ]);
        Scheduler::create([
            'name' => "total_alasan_cuti",
            'query' => "SELECT *
                        FROM (
                        SELECT 'ppnasn' as kelompok, 'sirajin' as 'data', 'total_alasan_cuti' AS 'judul', coalesce(cuti.keterangan, 'tidak ada alasan') as 'keterangan', count(*) as 'jumlah'
                        FROM db_sirajin_ppnasn.cuti as cuti
                        GROUP BY cuti.keterangan
                        ) AS query;",
        ]);
        $postgreDatabase = Database::create([
            'name' => "postgre_localhost",
            'driver' => "pgsql",
            'host' => "127.0.0.1",
            'port' => "5432",
            'database' => "test_postgre",
            'username' => "postgres",
            'password' => "password",
        ]);
        Scheduler::create([
            'name' => "postgre dummy data test",
            'query' => "SELECT *
                            FROM (
                            SELECT 'dummy' as group, 'arithmetic dummies' as data, 'postgre_total_dummy_data' AS judul, 'total_dummy_data_a' AS keterangan, sum(a) AS jumlah
                            FROM dummy_database.dummy_data_1
                            UNION
                            SELECT 'dummy' as group, 'arithmetic dummies' as data, 'postgre_total_dummy_data' AS judul, 'total_dummy_data_b' AS keterangan, sum(b) AS jumlah
                            FROM dummy_database.dummy_data_1
                            UNION
                            SELECT 'dummy' as group, 'arithmetic dummies' as data, 'postgre_total_dummy_data' AS judul, 'total_dummy_data_c' AS keterangan, sum(c) AS jumlah
                            FROM dummy_database.dummy_data_1
                        ) AS query;",
            'database_id' => $postgreDatabase->id
        ]);
    }
}
