<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'ttransaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = true;

    protected $fillable = ['total_harga', 'bayar', 'kembalian'];

    public function detailTransaksi()
{
    return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
}

}
