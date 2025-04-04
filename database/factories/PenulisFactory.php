<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penulis>
 */
class PenulisFactory extends Factory
{
    protected $model = \App\Models\Penulis::class; //Hubungin factory dengan model Penulis

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(), //Nama penulis random
            'alamat' => $this->faker->address(), //Alamat random
            'tlep' => $this->faker->phoneNumber(), //Nomor telepon random
        ];
    }
}
