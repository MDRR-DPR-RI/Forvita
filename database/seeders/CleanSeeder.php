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
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Islam",
            'jumlah' => 80,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            // 'created_at' => '2023-11-12 18:54:00'
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Kristen",
            'jumlah' => 20,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            // 'created_at' => '2023-11-12 18:54:00'
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Budha",
            'jumlah' => 10,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            // 'created_at' => '2023-11-12 18:54:00'
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Hindu",
            'jumlah' => 25,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            // 'created_at' => '2023-11-12 18:54:00'
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 10,
            'newest' => false, // ini tidak akan di render ketika milih data di edit_chart view
            // 'created_at' => '2023-11-12 18:54:00'
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Islam",
            'jumlah' => 800,
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Kristen",
            'jumlah' => 200,
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Budha",
            'jumlah' => 150,
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Hindu",
            'jumlah' => 235,
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 198,
            // 'created_at' => '2023-11-12 19:00:00'

        ]);
        Clean::create([
            'grup' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Islam",
            'jumlah' => 723,
        ]);
        Clean::create([
            'grup' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Kristen",
            'jumlah' => 292,
        ]);
        Clean::create([
            'grup' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Budha",
            'jumlah' => 129,
        ]);
        Clean::create([
            'grup' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Hindu",
            'jumlah' => 125,
        ]);
        Clean::create([
            'grup' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Konghucu",
            'jumlah' => 129,
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin Anggota",
            'keterangan' => "L",
            'jumlah' => 350,
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin Anggota",
            'keterangan' => "P",
            'jumlah' => 260,
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin SDMA",
            'keterangan' => "P",
            'jumlah' => 912,
        ]);
        Clean::create([
            'grup' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin SDMA",
            'keterangan' => "P",
            'jumlah' => 720,
        ]);
        Clean::create([
            'grup' => "Manusia",
            'data' => "Tubuh",
            'judul' => "Jumlah Bagian Tubuh",
            'keterangan' => "Hidung",
            'jumlah' => 1,
        ]);
        Clean::create([
            'grup' => "Manusia",
            'data' => "Tubuh",
            'judul' => "Jumlah Bagian Tubuh",
            'keterangan' => "Tangan",
            'jumlah' => 2,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Jan",
            'jumlah' => 95,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Feb",
            'jumlah' => 22,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Mar",
            'jumlah' => 92,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Apr",
            'jumlah' => 96,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Jan",
            'jumlah' => 43,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Feb",
            'jumlah' => 29,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Mar",
            'jumlah' => 53,
        ]);
        Clean::create([
            'grup' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Apr",
            'jumlah' => 93,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "Jumlah populasi yang ada di Indonesia",
            'keterangan' => "DKI Jakarta",
            'jumlah' => 93,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Jawa Barat",
            'jumlah' => 179,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Kalimantan Tengah",
            'jumlah' => 19,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Kalimantan Timur",
            'jumlah' => 49,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Indonesia",
            'judul' => "Jumlah populasi yang ada di Indonesia",
            'keterangan' => "Gorontalo",
            'jumlah' => 29,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Malaysia",
            'judul' => "Jumlah populasi yang ada di Malaysia",
            'keterangan' => "kualalumpur",
            'jumlah' => 12,
        ]);
        Clean::create([
            'grup' => "POPULASI",
            'data' => "Populasi Malaysia",
            'judul' => "Jumlah populasi yang ada di Malaysia",
            'keterangan' => "sabah",
            'jumlah' => 3,
        ]);
    }
}
