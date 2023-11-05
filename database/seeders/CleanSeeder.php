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
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Islam",
            'jumlah' => 800,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Kristen",
            'jumlah' => 200,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Budha",
            'jumlah' => 150,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Hindu",
            'jumlah' => 235,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 100,
            'newest' => false // ini tidak akan di render ketika milih data di edit_chart view
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama Anggota",
            'keterangan' => "Konghucu",
            'jumlah' => 198,
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Islam",
            'jumlah' => 723,
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Kristen",
            'jumlah' => 292,
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Budha",
            'jumlah' => 129,
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Hindu",
            'jumlah' => 125,
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Konghucu",
            'jumlah' => 23,
            'newest' => false // ini tidak akan di render ketika milih data di edit_chart view
        ]);
        Clean::create([
            'cluster' => "SDMA",
            'data' => "Agama",
            'judul' => "Jumlah penganut Agama SDMA",
            'keterangan' => "Konghucu",
            'jumlah' => 129,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin Anggota",
            'keterangan' => "L",
            'jumlah' => 350,
        ]);
        Clean::create([
            'cluster' => "Anggota",
            'data' => "Jenis Kelamin",
            'judul' => "Jumlah Jenis Kelamin Anggota",
            'keterangan' => "P",
            'jumlah' => 260,
        ]);
        Clean::create([
            'cluster' => "Manusia",
            'data' => "Tubuh",
            'judul' => "Jumlah Bagian Tubuh",
            'keterangan' => "Hidung",
            'jumlah' => 1,
        ]);
        Clean::create([
            'cluster' => "Manusia",
            'data' => "Tubuh",
            'judul' => "Jumlah Bagian Tubuh",
            'keterangan' => "Tangan",
            'jumlah' => 2,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Jan",
            'jumlah' => 95,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Feb",
            'jumlah' => 22,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Mar",
            'jumlah' => 92,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Ayam",
            'keterangan' => "Apr",
            'jumlah' => 96,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Jan",
            'jumlah' => 43,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Feb",
            'jumlah' => 29,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Mar",
            'jumlah' => 53,
        ]);
        Clean::create([
            'cluster' => "Ticket",
            'data' => "Penjualan Ticket",
            'judul' => "Penjualan Ticket Bebek",
            'keterangan' => "Apr",
            'jumlah' => 93,
        ]);
    }
}
