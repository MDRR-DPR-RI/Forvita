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
            'name' => "Embad Tablue",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Column Bar Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Stacked Bar Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Line Area Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Bar Chart With Border Radius",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Radial Bar (%)",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Stacked Side Bar Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "AI Analyst",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Multiple Line Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Donut Chart",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Card",
            'grid' => 2
        ]);
        Chart::create([
            'name' => "Table",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Side Bar Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Pie Chart",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Group of Circle",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Map Indonesia",
            'grid' => 12
        ]);
    }
}
