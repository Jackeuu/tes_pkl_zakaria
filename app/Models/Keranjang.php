<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'id'; // kalau primary key di keranjang adalah id, biarkan
    public $timestamps = true;

    protected $fillable = ['idb', 'qty'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idb', 'idb');
    }
}
