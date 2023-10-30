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
        return [
            'cluster_id' => mt_rand(1, 2),
            'name' => 'dasboard-' . fake()->word(),
            'description' =>  fake()->paragraph(),
        ];
    }
}
