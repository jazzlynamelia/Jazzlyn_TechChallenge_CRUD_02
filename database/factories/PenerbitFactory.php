<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penerbit>
 */
class PenerbitFactory extends Factory
{
    protected $model = \App\Models\Penerbit::class; //Hubungin factory dengan model Penerbit

    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(), //Nama penerbit random
            'alamat' => $this->faker->address(), //Alamat random
            'tlep' => $this->faker->phoneNumber(), //Nomor telepon random
        ];
    }
}
