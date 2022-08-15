<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk;
use DB;
use Exception;

class ProdukController extends Controller
{
    public function index() {

    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_product' => 'required|string|max:225',
            'jml_masuk' => 'required|integer|max:225',
            'jml_keluar' => 'required|integer|max:225',
            'total' => 'required|integer|max:225',
            'tgl_produk_masuk' => 'required',
            'harga_jual' => 'required|integer|max:225',
            'harga_beli' => 'required|integer|max:225',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'faied',
                'messages' => $validator->errors(),
            ];

        }

        $time = strtotime($request->tgl_produk_masuk);
        $tgl_produk_masuk = date("Y-m-d", $time);
        
        DB::beginTransaction();
        try {
            
            $produk = new Produk;
            $produk->nama_product = $request->nama_product;
            $produk->jml_masuk = $request->jml_masuk;
            $produk->jml_keluar = $request->jml_keluar;
            $produk->total = $request->total;
            $produk->tgl_produk_masuk = $tgl_produk_masuk;
            $produk->harga_jual = $request->harga_jual;
            $produk->harga_beli = $request->harga_beli;
    
            $produk->save();

            $response = [
            'status' => 'success',
            'nama_product' => $produk->nama_product,
            'jml_masuk' => $produk->jml_masuk,
            'jml_keluar' => $produk->jml_keluar,
            'total' => $produk->total,
            'tgl_produk_masuk' => date("d-m-Y", strtotime($produk->tgl_produk_masuk)),
            'harga_jual' => $produk->harga_jual,
            'harga_beli' => $produk->harga_beli,
            ];

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            
            $response = [
                'status' => 'failed',
                'messages' => $e->getMessage(),
            ];
        }

        return response()->json($response, 200);

    }
}
