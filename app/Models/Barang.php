<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'tbarang';
    protected $primaryKey = 'idb'; // primary key bukan id
    public $timestamps = false; // kalau tabel tidak punya created_at dan updated_at
    protected $fillable = ['id_users', 'nama_barang', 'harga_modal', 'harga_jual', 'stok', 'gambar'];
}
