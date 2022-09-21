<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan', 'no_hp', 'no_resi', 'produk_id', 'jumlah', 'tgl_pesanan', 'harga', 'penjualan_via'
    ];
}
