<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tdetail_transaksi';

    protected $fillable = ['id_transaksi', 'idb', 'qty', 'harga_jual', 'subtotal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idb');
    }

}
