<?php

namespace App\Http\Controllers;

use App\Models\Penulis; //Import model Penulis agar bisa digunakan
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    //READ (GET ALL): Ambil semua data penulis beserta buku yang ditulis
    public function index()
    {
        return Penulis::with('bukus')->get(); 
        //Ambil semua penulis dari database dan data relasinya dengan 'bukus'
        //menggunakan relation 'hasMany' yang sblmnya sudah didefinisikan di Penulis.php
    }

    //CREATE (POST): Simpan data penulis baru ke dalam database
    public function store(Request $request)
    {
        //Validasi input dari request
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', //Alamat boleh kosong, jika diisi harus bertipe string
            'tlep' => 'nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus bertipe string max 15 karakter
        ]);

        return Penulis::create($validated); //Simpan data penulis yang uda divalidasi ke database
    }

    //READ (GET): Ambil satu data penulis berdasarkan ID
    public function show(string $id)
    {
        $penulis = Penulis::with('bukus')->find($id); //Cari penulis berdasarkan ID beserta data buku yang ditulisnya
        
        //Jika penulis ga ketemu, return error message
        if (!$penulis) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }
        //Jika ketemu, return data penulis dalam format JSON
        return response()->json($penulis);
    }

    //UPDATE (PUT): Perbarui data penulis berdasarkan ID
    public function update(Request $request, string $id)
    {
        $penulis = Penulis::find($id); //Cari data penulis berdasarkan ID

        //Jika penulis ga ketemu, return error message
        if (!$penulis) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }

        //Jika penulis ketemu
        //Validasi input dari request
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255', //Jika diisi, nama harus string max 255 karakter
            'alamat' => 'sometimes|nullable|string', //Alamat boleh kosong, jika diisi harus string
            'tlep' => 'sometimes|nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus string max 15 karakter
        ]);

        $penulis->update($validated); //Update data penulis di database
        return response()->json($penulis); //Return data yang telah diperbarui dalam format JSON
    }

    //DELETE: Hapus data penulis berdasarkan ID
    public function destroy(string $id)
    {
        $penulis = Penulis::find($id); //Cari data penulis berdasarkan ID

        //Jika penulis ga ketemu, return error message
        if (!$penulis) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }
        //Jika penulis ketemu
        $penulis->delete(); //Hapus data penulis dari database
        return response()->json(['message' => 'Penulis berhasil dihapus']); //Return success message dalam format JSON
    }
}
