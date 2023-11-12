<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->unique()->word,
            'gambar' => $this->faker->imageUrl(640, 480, 'food'),
        ];
    }
}
