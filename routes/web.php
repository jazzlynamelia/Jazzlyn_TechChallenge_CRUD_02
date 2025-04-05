<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController; //Import controller untuk Buku
use App\Http\Controllers\PenulisController; //Import controller untuk Penulis
use App\Http\Controllers\PenerbitController; //Import controller untuk Penerbit

Route::get('/', function () {
    return view('welcome');
});

//Buku (Web View)
Route::get('/buku', [BukuController::class, 'listBuku'])->name('buku.view'); //Tampilin daftar buku
Route::get('/buku/create', [BukuController::class, 'createForm'])->name('buku.create'); //Tampilin form tambah buku
Route::post('/buku', [BukuController::class, 'storeForm'])->name('buku.store'); //Simpan data buku dari form
Route::get('/buku/{id}/edit', [BukuController::class, 'editForm'])->name('buku.edit'); //Tampilin form edit buku berdasarkan id
Route::put('/buku/{id}', [BukuController::class, 'updateForm'])->name('buku.update'); //Update data buku berdasarkan id
Route::delete('/buku/{id}', [BukuController::class, 'deleteForm'])->name('buku.destroy'); //Hapus buku berdasarkan id

//Penulis Web View
Route::get('/penulis', [PenulisController::class, 'listPenulis'])->name('penulis.view'); //Tampilin daftar penulis
Route::get('/penulis/create', [PenulisController::class, 'createForm'])->name('penulis.create'); //Tampilin form tambah penulis
Route::post('/penulis/store', [PenulisController::class, 'storeForm'])->name('penulis.store'); //Simpan data penulis dari form
Route::get('/penulis/edit/{id}', [PenulisController::class, 'editForm'])->name('penulis.edit'); //Tampilin form edit penulis berdasarkan id
Route::put('/penulis/update/{id}', [PenulisController::class, 'updateForm'])->name('penulis.update'); //Update data penulis berdasarkan id
Route::delete('/penulis/delete/{id}', [PenulisController::class, 'deleteForm'])->name('penulis.delete'); //Hapus penulis berdasarkan id

//Penerbit Web View
Route::get('/penerbit', [PenerbitController::class, 'listPenerbit'])->name('penerbit.view'); //Tampilin daftar penerbit
Route::get('/penerbit/create', [PenerbitController::class, 'createForm'])->name('penerbit.create'); //Tampilin form tambah penerbit
Route::post('/penerbit/store', [PenerbitController::class, 'storeForm'])->name('penerbit.store'); //Simpan data penerbit dari form
Route::get('/penerbit/edit/{id}', [PenerbitController::class, 'editForm'])->name('penerbit.edit'); //Tampilin form edit penerbit berdasarkan id
Route::put('/penerbit/update/{id}', [PenerbitController::class, 'updateForm'])->name('penerbit.update'); //Update data penerbit berdasarkan id
Route::delete('/penerbit/delete/{id}', [PenerbitController::class, 'deleteForm'])->name('penerbit.delete'); //Hapus penerbit berdasarkan id
