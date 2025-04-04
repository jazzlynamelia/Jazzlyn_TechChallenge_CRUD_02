<?php

namespace App\Http\Controllers;

use App\Models\Buku; //Import model Buku agar bisa digunakan
use Illuminate\Http\Request;

class BukuController extends Controller
{
    //READ (GET ALL): Ambil semua data buku
    public function index()
    {
        return Buku::with(['penulis', 'penerbit'])->get(); //Ambil semua data buku (termasuk relasi dengan penulis dan penerbit)
    }

    //CREATE (POST): Simpan data buku baru ke dalam database
    public function store(Request $request)
    {
        //Validasi input dari request
        $validated = $request->validate([
            'judul' => 'required|string|max:255', //Judul wajib diisi, bertipe string, max 255 karakter
            'tahun_terbit' => 'required|integer', //Tahun terbit wajib diisi, bertipe angka bulat
            'stok' => 'required|integer|min:0', //Stok wajib diisi, bertipe angka bulat, tidak boleh negatif
            'isbn' => 'required|string|unique:bukus,isbn', //ISBN wajib diisi, bertipe string, unik agar ga redundan
            'penulis_id' => 'required|exists:penulis,id', //Penulis_id wajib diisi, harus ada di tabel penulis
            'penerbit_id' => 'required|exists:penerbit,id', //Penerbit_id wajib diisi, harus ada di tabel penerbit
        ]);

        $buku = Buku::create($validated); //Simpan data buku baru yg sudah lolos validasi ke database
        return response()->json($buku, 201); //Mengembalikan response dengan status 201 (Created)
    }

    //READ (GET): Ambil satu data buku berdasarkan ID
    public function show(string $id)
    {
        $buku = Buku::with(['penulis', 'penerbit'])->find($id); //Cari buku berdasarkan ID, ambil data buku beserta data penulis & penerbit

        //Jika buku ga ketemu, return error message
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }
        //Jika ketemu, return data buku dalam format JSON
        return response()->json($buku);
    }

    //UPDATE (PUT): Perbarui data buku berdasarkan ID
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id); //Cari buku berdasarkan ID

        //Jika buku ga ketemu, return error message
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        //Jika buku ketemu
        //Validasi data yang akan diupdate
        $validated = $request->validate([
            'judul' => 'sometimes|required|string|max:255', //Jika diisi, judul harus string max 255 karakter
            'tahun_terbit' => 'sometimes|required|integer', //Jika diisi, tahun terbit harus angka bulat
            'stok' => 'sometimes|required|integer|min:0', //Jika diisi, stok harus angka bulat minimal 0
            'isbn' => 'sometimes|required|string|unique:bukus,isbn,' . $id, //Jika diisi, isbn harus unik kecuali yang sedang diedit
            'penulis_id' => 'sometimes|required|exists:penulis,id', //Jika diisi, harus ada di tabel penulis
            'penerbit_id' => 'sometimes|required|exists:penerbit,id', //Jika diisi, harus ada di tabel penerbit
        ]);

        $buku->update($validated); //Update data buku yang ditemuin dengan data yang uda divalidasi
        return response()->json($buku); //Return data yang telah diperbarui dalam format JSON
    }

    //DELETE: Hapus buku berdasarkan ID
    public function destroy(string $id)
    {
        $buku = Buku::find($id); //Cari buku berdasarkan ID

        //Jika buku ga ketemu, return error message
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        //Jika buku ketemu
        $buku->delete(); //Hapus buku dari database
        return response()->json(['message' => 'Buku berhasil dihapus']); //Return success message dalam format JSON
    }
}
