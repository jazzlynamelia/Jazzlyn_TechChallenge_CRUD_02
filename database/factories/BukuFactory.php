<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Penulis; //Import model Penulis
use App\Models\Penerbit; //Import model Penerbit

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    protected $model = \App\Models\Buku::class; //Hubungin factory dengan model Buku

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3), //Judul buku random (3 kata)
            'tahun_terbit' => $this->faker->year(), //Tahun terbit random
            'stok' => $this->faker->numberBetween(1, 50), //Stok random  (1-50)
            'isbn' => $this->faker->unique()->isbn13(), //ISBN unik random
            'penulis_id' => Penulis::inRandomOrder()->first()->id, //Ambil random satu ID penulis yg uda ada
            'penerbit_id' => Penerbit::inRandomOrder()->first()->id, //Ambil random satu ID penerbit yg uda ada
        ];
    }
}
