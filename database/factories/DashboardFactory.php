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
            'bi bi-pie-chart', 'bi bi-alarm-fill', 'bi bi-align-bottom', 'bi bi-align-center', 'bi bi-align-end', 'bi bi-people-fill'
        ];
        return [
            'cluster_id' => mt_rand(1, 2),
            'name' => 'dasboard-' . fake()->word(),
            'description' =>  fake()->sentence(),
            'icon_name' => $iconNames[array_rand($iconNames)]
        ];
    }
}
