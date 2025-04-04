<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Buku;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Buat 10 penulis
        Penulis::factory(10)->create();

        //Buat 5 penerbit
        Penerbit::factory(5)->create();

        //Buat 25 buku (dengan penulis & penerbit yang uda dibuat)
        Buku::factory(25)->create();
    }
}
