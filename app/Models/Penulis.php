<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //Import trait untuk buat factory (data dummmy)
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory; //Aktifin factory

    protected $table = 'penulis'; //Override buat pastiin kehubung ke tabel penulis
    protected $fillable = ['nama', 'alamat', 'tlep']; //Tentuin kolom yg boleh diisi massal

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'penulis_id');
        //Bikin relasi foreign key 'penulis_id' di tabel bukus 
        //Satu penulis bisa punya banyak buku
    }
}
