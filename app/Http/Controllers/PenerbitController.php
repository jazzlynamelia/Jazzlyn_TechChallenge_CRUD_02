<?php

namespace App\Http\Controllers;

use App\Models\Penerbit; //Import model Penerbit agar bisa digunakan
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    //============== API ==================

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

    //============== Web View ==================

    //Tampilin halaman daftar semua penerbit
    public function listPenerbit()
    {
        $penerbits = Penerbit::all(); //Ambil semua penerbit dari database
        return view('penerbit.index', compact('penerbits')); //Return ke view 'penerbit/index' dan kirim data penerbit ke view
    }

    //Tampilin halaman tambah penerbit
    public function createForm()
    {
        return view('penerbit.create'); //Return view 'penerbit/create'
    }

    //Simpan penerbit baru dari form ke database
    public function storeForm(Request $request)
    {
        //Validasi form input
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', ///Alamat boleh kosong, jika diisi harus string
            'tlep' => 'nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus string max 15 karakter
        ]);

        Penerbit::create($validated); //Simpan data yang udah divalidasi ke database
        return redirect()->route('penerbit.view')->with('success', 'Penerbit berhasil ditambahkan!'); //Redirect ke halaman daftar penerbit
    }

    //Tampilin halaman edit penerbit
    public function editForm($id)
    {
        $penerbit = Penerbit::findOrFail($id); //Cari penerbit berdasarkan ID, kalau ga ketemu error 404
        return view('penerbit.edit', compact('penerbit')); //Tampilin view 'penerbit/edit' dengan data penerbit
    }

    //Update data penerbit dari form edit
    public function updateForm(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id); //Cari penerbit berdasarkan ID

        //Validasi form input
        $validated = $request->validate([
            'nama' => 'required|string|max:255', //Nama wajib diisi, bertipe string, max 255 karakter
            'alamat' => 'nullable|string', //Alamat boleh kosong, jika diisi harus string
            'tlep' => 'nullable|string|max:15', //Nomor telepon boleh kosong, jika diisi harus string max 15 karakter
        ]);

        $penerbit->update($validated); //Update data penerbit dengan data yang divalidasi
        return redirect()->route('penerbit.view')->with('success', 'Penerbit berhasil diperbarui!'); //Redirect ke halaman daftar penerbit
    }

    //Hapus penerbit dari database berdasarkan ID
    public function deleteForm($id)
    {
        $penerbit = Penerbit::findOrFail($id); //Cari penerbit berdasarkan ID
        $penerbit->delete(); //Hapus data penerbit
        return redirect()->route('penerbit.view')->with('success', 'Penerbit berhasil dihapus!'); //Redirect ke halaman daftar penerbit
    }
}
