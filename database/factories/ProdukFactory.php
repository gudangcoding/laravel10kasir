<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Produk::class;

    public function definition()
    {
        return [
            'kode_produk' => $this->faker->unique()->ean8,
            'nama_produk' => $this->faker->unique()->word,
            'gambar' => $this->faker->imageUrl(640, 480, 'food'), // Contoh URL gambar placeholder
            'merk' => $this->faker->word,
            'harga_beli' => $this->faker->randomFloat(2, 10, 1000),
            'diskon' => $this->faker->randomFloat(2, 0, 20),
            'harga_jual' => function (array $attributes) {
                return $attributes['harga_beli'] * (1 - $attributes['diskon'] / 100);
            },
            'stok' => $this->faker->numberBetween(0, 100),
            'stok_minimal' => $this->faker->numberBetween(0, 50),
            'id_kategori' => 1,
            'id_satuan' => 1,
        ];
    }
    
}
