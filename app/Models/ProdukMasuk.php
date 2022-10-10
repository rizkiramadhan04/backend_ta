<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id', 'jumlah', 'tgl_produk_masuk', 'pemasok_id',
    ];
}
