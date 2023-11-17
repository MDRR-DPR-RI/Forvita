<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dashboard>
 */
class DashboardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $iconNames = [
            'bi bi-pie-chart', 'bi bi-bar-chart', 'bi bi-line-chart', 'bi bi-pie-chart-fill',
            'bi bi-arrow-up-circle', 'bi bi-arrow-down-circle', 'bi bi-arrow-left-circle', 'bi bi-arrow-right-circle',
            'bi bi-file-text', 'bi bi-file-image', 'bi bi-file-music', 'bi bi-file-code',
            'bi bi-headset', 'bi bi-mouse', 'bi bi-keyboard', 'bi bi-laptop',
            'bi bi-camera', 'bi bi-telephone', 'bi bi-watch', 'bi bi-cloud'
        ];
        return [
            'cluster_id' => mt_rand(1, 2),
            'name' => 'dasboard-' . fake()->word(),
            'description' =>  fake()->sentence(),
            'icon_name' => $iconNames[array_rand($iconNames)]
        ];
    }
}
