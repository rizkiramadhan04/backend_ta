<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {

        $produk_max = DB::table('produks')->orderBy('jml_keluar', 'desc')->limit(5)->get();
        $produk_min = DB::table('produks')->orderBy('jml_keluar', 'asc')->limit(3)->get();
        $stok_sdkt = DB::table('produks')->where('total', '<', 10)->first();

        $date = date('Y-m-d');
        $stock = DB::table('penjualans')->where('tgl_pesanan', $date)->get()->count();

        $stok_sdkt_name = (!empty($stok_sdkt)) ? $stok_sdkt->nama_produk : "Belum ada produk kosong!"; 
        

        return view('admin.home', compact('produk_max', 'produk_min', 'stok_sdkt_name', 'stock'));

        // dd($stok_sdkt);
    }
}
