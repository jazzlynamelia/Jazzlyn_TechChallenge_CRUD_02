<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //Import trait untuk buat factory (data dummmy)
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory; //Aktifin factory

    protected $table = 'bukus'; //Override buat pastiin kehubung ke tabel bukus
    protected $fillable = ['judul', 'tahun_terbit', 'stok', 'isbn', 'penulis_id', 'penerbit_id']; //Tentuin kolom yg boleh diisi massal

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id');
        //Foreign key 'penulis_id' untuk hubungin ke model Penulis
        //Setiap buku ditulis oleh satu penulis
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
        //Foreign key 'penerbit_id' untuk hubungin ke model Penerbit
        //Setiap buku diterbitin oleh satu penerbit
    }
}
