<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RUU>
 */
class RUUFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $words = ['Dpr', 'Dpd', 'Pemerintah'];
        $judul = ['RUU tentang Keamanan dan Ketahanan Siber', 'RUU tentang Perubahan atas Undang-Undang Nomor 32 Tahun 2002 tentang Penyiaran', 'RUU tentang Radio Televisi Republik Indonesia', '	RUU tentang Keamanan Laut'];

        return [
            'judul' => fake()->randomElement($judul),
            'bulan_id' =>  mt_rand(1, 12),
            'pengusul' => fake()->randomElement($words),
        ];
    }
}
