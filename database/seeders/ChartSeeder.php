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
        // LINE CHART
        Chart::create([
            'name' => "Line Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Line Chart (smooth)",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Line Chart (stepline)",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Line Area Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Line Area Chart (smooth)",
            'grid' => 6
        ]);
        Chart::create([ // id=6
            'name' => "Line Area Chart (stepline)",
            'grid' => 6
        ]);
        // BAR AND COLUMN CHART
        Chart::create([ // id=7
            'name' => "Bar Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Bar Chart (reversed)",
            'grid' => 6
        ]);
        Chart::create([ // id=9
            'name' => "Bar Chart With Border Radius",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Bar Chart With Border Radius (reversed)",
            'grid' => 6
        ]);
        Chart::create([ // id=11
            'name' => "Stacked Bar Chart",
            'grid' => 6
        ]);
        Chart::create([ // id=12
            'name' => "Stacked Bar Chart (reversed)",
            'grid' => 6
        ]);
        // column chart
        Chart::create([ // id = 13
            'name' => "Column Chart",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Column Chart With Border Radius",
            'grid' => 6
        ]);
        Chart::create([ // id=15
            'name' => "Stacked Column Chart",
            'grid' => 6
        ]);
        // Donut and Pie Chart
        Chart::create([
            'name' => "Donut Chart",
            'grid' => 4
        ]);
        Chart::create([ // id=17
            'name' => "Pie Chart",
            'grid' => 4
        ]);
        // OTHERS
        Chart::create([ // id=18
            'name' => "Embed Tableau",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Map Indonesia",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "AI Analisis",
            'grid' => 4
        ]);
        Chart::create([
            'name' => "Kartu",
            'grid' => 2
        ]);
        Chart::create([
            'name' => "Tabel",
            'grid' => 6
        ]);
        Chart::create([
            'name' => "Kumpulan Lingkaran",
            'grid' => 12
        ]);
        Chart::create([
            'name' => "Radial Bar (%)",
            'grid' => 4
        ]);
    }
}
