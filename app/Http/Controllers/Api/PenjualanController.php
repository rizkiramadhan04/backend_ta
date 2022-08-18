<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index() {

    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'no_resi' => 'required',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'tgl_pesenan' => 'required',
            'total' => 'required',
            'total_jml_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ], 500);
        }

        DB::beginTransaction();

        try {
                $penjualan = new Penjualan;
                $penjualan->nama_pelanggan = $request->nama_pelanggan;
                $penjualan->no_hp = $request->no_hp;
                $penjualan->no_resi = $request->no_resi;
                $penjualan->nama_produk = $request->nama_product;
                $penjualan->jumlah_produk = $request->jumlah_produk;
                $penjualan->tgl_pesenan = $request->tgl_pesenan;
                $penjualan->total = $request->total;
                $penjualan->total_jml_produk = $request->total_jml_brg;

                $penjualan->save();

                // if ($penjualan->save()) {
                //     $nama_produk = $penjualan->nama_product;
                //     $produk = Produk::where('nama_produk', $nama_produk)->first();
                //     $produk->update([]);

                // }

                $response = [
                    'status' => 'success',
                    'data' => [
                        'penjualan' => $penjualan,
                        'produk' => [$produk],
                    ],
                ];
                DB::commit();

                } catch (Exception $e) {

                    DB::rollback();

                    $response = [
                        'status' => 'failed',
                        'message' => $e->getMessage(),
                    ];
        }

        return response()->json($response, 200);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'no_resi' => 'required',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'tgl_pesenan' => 'required',
            'total' => 'required',
            'total_jml_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ], 500);
        }

        $penjualan = Penjualan::whereId($request->input(id))->first();

        DB::beginTransaction();

        try {

            $penjualan->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'no_resi' => $request->no_resi,
                'nama_produk' => $request->nama_product,
                'jumlah_produk' => $request->jumlah_produk,
                'tgl_pesenan' => $request->tgl_pesenan,
                'total' => $request->total,
                'total_jml_produk' => $request->total_jml_brg,
                
            ]);

                $penjualan->update();

                // if ($penjualan->save()) {
                //     $nama_produk = $penjualan->nama_product;
                //     $produk = Produk::where('nama_produk', $nama_produk)->first();
                //     $produk->update([]);

                // }

                $response = [
                    'status' => 'success',
                    'data' => [
                        'penjualan' => $penjualan,
                        'produk' => [$produk],
                    ],
                ];
                DB::commit();

                } catch (Exception $e) {

                    DB::rollback();

                    $response = [
                        'status' => 'failed',
                        'message' => $e->getMessage(),
                    ];
        }

        return response()->json($response, 200);
    }

    public function delete(Request $request) {
        $penjualan = Penjualan::findOrFail($request->id);
        $penjualan->delete();


        if ($penjualan) {
            $response = [
                'status' => 'success',
                'message' => 'Hapus Data Berhasil !',
            ];    
        } else {
            $response = [
                'status' => 'Failed',
                'message' => 'Hapus Data Tidak  Berhasil !',
            ];   
        }

        return response()->json($response, 200);
    }
}
