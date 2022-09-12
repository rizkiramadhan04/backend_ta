<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan', 'no_hp', 'no_resi', 'nama_product', 'jumlah_produk', 'tgl_pesenan', 'harga_produk', 'total_harga', 'total_jml_brg', 'produks_id'
    ];
}
