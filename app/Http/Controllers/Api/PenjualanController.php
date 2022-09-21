<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Penjualan;
use App\Models\Produk;
use DB;
use Exception;

class PenjualanController extends Controller
{
    public function getPenjualan() {
        $penjualan = Penjualan::select('penjualans.*', 'produks.nama_produk as nama_produk')->join('produks', 'produks.id', '=', 'penjualans.produk_id')->get();

        return response()->json([
            'status' => 'success',
            'data' => $penjualan,
        ]);
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'no_resi' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required',
            'tgl_pesanan' => 'required',
            'harga' => 'required',
            'penjualan_via' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try {
            
        $penjualan = new Penjualan();
        $penjualan->nama_pelanggan  = $request->nama_pelanggan;
        $penjualan->no_hp           = $request->no_hp;
        $penjualan->no_resi         = $request->no_resi;
        $penjualan->produk_id       = $request->produk_id;
        $penjualan->jumlah          = $request->jumlah;
        $penjualan->tgl_pesanan     = $request->tgl_pesanan;
        $penjualan->harga           = $request->harga;
        $penjualan->penjualan_via   = $request->penjualan_via;
        $penjualan->save();

        DB::commit();

        if ($penjualan->save()) {
            $produk = Produk::findOrFail($penjualan->produk_id)->first();
            $produk->update([
                'jml_keluar' => ($produk->jml_keluar + $penjualan->jumlah),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $penjualan,
        ]);
            
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
