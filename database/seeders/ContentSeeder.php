<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Content::create([
            'chart_id' => 9,
            'dashboard_id' => 1,
            'judul' => '["Jumlah penganut Agama Anggota"]',
            'card_title' => 'Jumlah Agama',
            'card_description' => 'Ini Description card',
            'card_grid' => 8,
            'x_value' => '[["Islam","Kristen","Budha","Hindu"]]',
            'y_value' => '[["800","200","150","235"]]',
            'color' => '["#9f0230"]'

        ]);
        Content::create([
            'chart_id' => 9,
            'dashboard_id' => 1,
            'judul' => '["Penjualan Ticket Ayam", "Penjualan Ticket Bebek"]',
            'card_title' => 'Penjualan Ticket',
            'card_description' => 'Total penjualan ticket dalam 4 bulan',
            'card_grid' => 4,
            'x_value' => '[["Jan","Feb","Mar","Apr"], ["Jan","Feb","Mar","Apr"]]',
            'y_value' => '[["95","22","92","96"], ["43","29","53","93"]]',
            'color' => '["#620230", "#fff70a"]'
        ]);
        Content::create([
            'chart_id' => 3,
            'dashboard_id' => 1,
            'judul' => '["Jumlah penganut Agama Anggota","Jumlah penganut Agama SDMA"]',
            'card_title' => 'Jumlah Agama',
            'card_description' => 'Ini Jumlah Penaganut Agama Anggota dan SDMA',
            'card_grid' => 6,
            'x_value' => '[["Islam","Kristen","Budha","Hindu","Konghucu"],["Islam","Kristen","Budha","Hindu","Konghucu"]]',
            'y_value' => '[[800,200,150,235,100],[723,292,129,125,23]]',
            'color' => '["#ff0000", "#000000"]'
        ]);
        Content::create([
            'chart_id' => 1,
            'dashboard_id' => 2,
            'judul' => '[]',
            'card_title' => 'tab',
            'card_description' => 'https://public.tableau.com/views/ThePeriodicTableofWine/periodictableauofwineEN?:language=en-US&:display_count=n&:origin=viz_share_link',
            'card_grid' => 12,
            'x_value' => '[[]]',
            'y_value' => '[[]]',
            'color' => '[]'
        ]);
    }
}
