<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            // Atribut dalam tabel bukus (kolom)
            $table->id();
            $table->string('judul');
            $table->integer('tahun_terbit');
            $table->integer('stok');
            $table->string('isbn')->unique();
            $table->unsignedBigInteger('penulis_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->timestamps();

            // Foreign key
            $table->foreign('penulis_id')->references('id')->on('penulis')->onDelete('cascade');
            $table->foreign('penerbit_id')->references('id')->on('penerbit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
