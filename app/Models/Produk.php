<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_products', 'jml_masuk', 'jml_keluar', 'total', 'tgl_produk_masuk', 'harga_jual', 'harga_beli'];
}
