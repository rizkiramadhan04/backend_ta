<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = Penjualan::select('penjualans.*', 'produks.nama_produk as nama_produk')->join('produks', 'produks.id', '=', 'penjualans.produk_id')->get();

        return view('admin.penjualan.index', [
            'item' => $penjualan,
        ]);
        
    }
}
