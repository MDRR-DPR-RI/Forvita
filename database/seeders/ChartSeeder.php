<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chart;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chart::create([
            'name' => "Nama 1",
            'grid' => 9
        ]);
        Chart::create([
            'name' => "Nama 2",
            'grid' => 3
        ]);
        Chart::create([
            'name' => "Nama 3",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Nama 4",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Nama 5",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Nama 6",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Nama 7",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Bar Chart With AI Analyst",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Multiple Line Chart",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Donut Chart",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Card",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Table",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Side Bar Chart",
            'grid' => 8
        ]);
        Chart::create([
            'name' => "Pie Chart",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Group of Circle",
            'grid' => 12
        ]);
    }
}
