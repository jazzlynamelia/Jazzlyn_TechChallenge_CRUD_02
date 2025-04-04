<?php

namespace App\Http\Controllers;

use App\Models\Penerbit; //Import model Penerbit agar bisa digunakan
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    //READ (GET ALL): Ambil semua data penerbit beserta buku yang diterbitkan
    public function index()
    {
        return Penerbit::with('bukus')->get();
        //Ambil semua penerbit dari database dan data relasinya dengan 'bukus'
        //menggunakan relation 'hasMany' yang sblmnya sudah didefinisikan di Penerbit.php
    }

    //CREATE (POST): Simpan data penerbit baru ke dalam database
    public function store(Request $request)
    {
        //Validasi input dari request
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', //Alamat boleh kosong, jika diisi harus bertipe string
            'tlep' => 'nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus bertipe string max 15 karakter
        ]);

        return Penerbit::create($validated); //Simpan data penerbit yang uda divalidasi ke database
    }

    //READ (GET): Ambil satu data penerbit berdasarkan ID
    public function show(string $id)
    {
        $penerbit = Penerbit::with('bukus')->find($id); //Cari penerbit berdasarkan ID beserta data buku yang diterbitkan

        //Jika penerbit ga ketemu, return error message
        if (!$penerbit) {
            return response()->json(['message' => 'Penerbit tidak ditemukan'], 404);
        }
        //Jika ketemu, return data penerbit dalam format JSON
        return response()->json($penerbit);
    }

    //UPDATE (PUT): Perbarui data penerbit berdasarkan ID
    public function update(Request $request, string $id)
    {
        $penerbit = Penerbit::find($id); //Cari data penerbit berdasarkan ID

        //Jika penerbit ga ketemu, return error message
        if (!$penerbit) {
            return response()->json(['message' => 'Penerbit tidak ditemukan'], 404);
        }

        //Jika penerbit ketemu
        // Validasi input dari request
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255', //Jika diisi, nama harus string dan max 255 karakter
            'alamat' => 'sometimes|nullable|string', //Alamat boleh kosong, jika diisi harus string
            'tlep' => 'sometimes|nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus string max 15 karakter
        ]);

        $penerbit->update($validated); //Update data penerbit di database
        return response()->json($penerbit); //Return data yang telah diperbarui dalam format JSON
    }

    //DELETE: Hapus data penerbit berdasarkan ID
    public function destroy(string $id)
    {
        $penerbit = Penerbit::find($id); //Cari data penerbit berdasarkan ID

        //Jika penerbit ga ketemu, return error message
        if (!$penerbit) {
            return response()->json(['message' => 'Penerbit tidak ditemukan'], 404);
        }

        //Jika penerbit ketemu
        $penerbit->delete(); //Hapus data penerbit dari database
        return response()->json(['message' => 'Penerbit berhasil dihapus']); //Return success message dalam format JSON
    }
}
