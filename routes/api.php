<?php

use Illuminate\Support\Facades\Route; //Import class Route untuk mendefinisikan route API
use App\Http\Controllers\BukuController; //Import BukuController agar dapat menangani route buku
use App\Http\Controllers\PenulisController; //Import PenulisController agar dapat menangani route penulis
use App\Http\Controllers\PenerbitController; //Import PenerbitController agar dapat menangani route penerbit

//Menggunakan Route::apiResource untuk CRUD Buku, Penulis, dan Penerbit
Route::apiResource('/buku', BukuController::class);
Route::apiResource('/penulis', PenulisController::class);
Route::apiResource('/penerbit', PenerbitController::class);