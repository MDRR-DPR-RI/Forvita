<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prompt;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // this prompt for ai analysis in chart_id = 8
        Prompt::create([
            'body' => "Nilai Tertinggi dan Terendah ",
        ]);
        Prompt::create([
            'body' => "Nilai Tertinggi",
        ]);
        Prompt::create([
            'body' => "Nilai Terendah",
        ]);
        Prompt::create([
            'body' => "Nilai rata-rata dari semua",
        ]);
    }
}
