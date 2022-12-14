<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'jml_masuk', 'jml_keluar', 'total', 'tgl_produk_masuk', 'harga_jual', 'harga_beli', 'pemasok_id', 'kode_produk'];
}
