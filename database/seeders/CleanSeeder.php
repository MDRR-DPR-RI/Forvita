<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clean;

class CleanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');

        $currentTimestamp = now();


        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Islam",
            'jumlah' => 800,
            'created_at' => $currentTimestamp
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Kristen",
            'jumlah' => 200,
            'created_at' => $currentTimestamp
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Budha",
            'jumlah' => 150,
            'created_at' => $currentTimestamp
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Hindu",
            'jumlah' => 235,
            'created_at' => $currentTimestamp
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 198,
            'created_at' => $currentTimestamp
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'kelompok' => "SDMA",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama SDMA",
            'keterangan' => "Islam",
            'jumlah' => 723,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "SDMA",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama SDMA",
            'keterangan' => "Kristen",
            'jumlah' => 292,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "SDMA",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama SDMA",
            'keterangan' => "Budha",
            'jumlah' => 129,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "SDMA",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama SDMA",
            'keterangan' => "Hindu",
            'jumlah' => 125,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "SDMA",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama SDMA",
            'keterangan' => "Konghucu",
            'jumlah' => 129,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "(Dummy) Jumlah Jenis Kelamin Anggota",
            'keterangan' => "L",
            'jumlah' => 350,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "(Dummy) Jumlah Jenis Kelamin Anggota",
            'keterangan' => "P",
            'jumlah' => 260,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "(Dummy) Jumlah Jenis Kelamin SDMA",
            'keterangan' => "P",
            'jumlah' => 912,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "(Dummy) Jumlah Jenis Kelamin SDMA",
            'keterangan' => "P",
            'jumlah' => 720,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Manusia",
            'data' => "Tubuh",
            'judul' => "(Dummy) Jumlah Bagian Tubuh",
            'keterangan' => "Hidung",
            'jumlah' => 1,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Manusia",
            'data' => "Tubuh",
            'judul' => "(Dummy) Jumlah Bagian Tubuh",
            'keterangan' => "Tangan",
            'jumlah' => 2,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Ayam",
            'keterangan' => "Jan",
            'jumlah' => 95,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Ayam",
            'keterangan' => "Feb",
            'jumlah' => 22,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Ayam",
            'keterangan' => "Mar",
            'jumlah' => 92,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Ayam",
            'keterangan' => "Apr",
            'jumlah' => 96,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Bebek",
            'keterangan' => "Jan",
            'jumlah' => 43,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Bebek",
            'keterangan' => "Feb",
            'jumlah' => 29,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Bebek",
            'keterangan' => "Mar",
            'jumlah' => 53,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "(Dummy) Penjualan Ticket Bebek",
            'keterangan' => "Apr",
            'jumlah' => 93,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Indonesia",
            'keterangan' => "DKI Jakarta",
            'jumlah' => 93,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Jawa Barat",
            'jumlah' => 179,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Kalimantan Tengah",
            'jumlah' => 19,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Kalimantan Timur",
            'jumlah' => 49,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Gorontalo",
            'jumlah' => 29,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Malaysia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Malaysia",
            'keterangan' => "kualalumpur",
            'jumlah' => 12,
            'created_at' => $currentTimestamp
        ]);
        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Malaysia",
            'judul' => "(Dummy) Jumlah populasi yang ada di Malaysia",
            'keterangan' => "sabah",
            'jumlah' => 3,
            'created_at' => $currentTimestamp
        ]);


        date_default_timezone_set('America/New_York'); // Set the timezone to Eastern Time

        $americaTimestamp = now();


        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Islam",
            'jumlah' => 80,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            'created_at' => $americaTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Kristen",
            'jumlah' => 20,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            'created_at' => $americaTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Budha",
            'jumlah' => 10,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            'created_at' => $americaTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Hindu",
            'jumlah' => 25,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            'created_at' => $americaTimestamp
        ]);
        Clean::create([
            'kelompok' => "Anggota",
            'data' => "Agama",
            'judul' => "(Dummy) Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 10,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            'created_at' => $americaTimestamp
        ]);

        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Dunia",
            'judul' => "(Dummy) Jumlah populasi yang ada di seluruh dunia",
            'keterangan' => "Indonesia",
            'jumlah' => 273800000,
            'created_at' => $currentTimestamp
        ]);

        Clean::create([
            'kelompok' => "POPULASI",
            'data' => "Populasi Dunia",
            'judul' => "(Dummy) Jumlah populasi yang ada di seluruh dunia",
            'keterangan' => "Australia",
            'jumlah' => 25690000,
            'created_at' => $currentTimestamp
        ]);
    }
}
