<?php

namespace App\Http\Controllers;

use App\Models\Penulis; //Import model Penulis agar bisa digunakan
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    //============== API ==================

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

    //============== Web View ==================
    //Tampilin halaman daftar semua penulis
    public function listPenulis()
    {
        $penulis = Penulis::all(); //Ambil semua data penulis dari database
        return view('penulis.index', compact('penulis')); //Kirim data ke view 'penulis/index.blade.php'
    }

    //Tampilin form tambah penulis
    public function createForm()
    {
        return view('penulis.create'); //Tampilin view form untuk tambah penulis
    }

    //Simpan penulis baru dari form ke database
    public function storeForm(Request $request)
    {
        //Validasi input dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', //Alamat boleh kosong, kalau diisi harus bertipe string
            'tlep' => 'nullable|string|max:15', //Telepon boleh kosong, kalau diisi bertipe string max 15 karakter
        ]);

        $penulis = Penulis::create($validated); //Simpan ke database
        return redirect()->route('penulis.view')->with('success', 'Penulis berhasil ditambahkan'); //Redirect ke daftar penulis
    }

    //Tampilin form edit penulis
    public function editForm($id)
    {
        $penulis = Penulis::findOrFail($id); //Cari penulis berdasarkan ID, kalau tidak ketemu akan error 404
        return view('penulis.edit', compact('penulis')); //Kirim data penulis ke form edit
    }

    //Update data penulis dari form
    public function updateForm(Request $request, $id)
    {
        $penulis = Penulis::findOrFail($id); //Cari penulis berdasarkan ID

        //Validasi input dari form edit
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', //Alamat boleh kosong, jika diisi harus string
            'tlep' => 'nullable|string|max:15', ///Nomor telepon boleh kosong, jika diisi harus string max 15 karakter
        ]);

        $penulis->update($validated); //Update data di database
        return redirect()->route('penulis.view')->with('success', 'Penulis berhasil diperbarui'); //Redirect ke daftar penulis
    }

    //Hapus penulis dari database
    public function deleteForm($id)
    {
        $penulis = Penulis::findOrFail($id); //Cari penulis berdasarkan ID
        $penulis->delete(); //Hapus data dari database

        return redirect()->route('penulis.view')->with('success', 'Penulis berhasil dihapus'); //Redirect ke halaman daftar dengan pesan sukses
    }
}
