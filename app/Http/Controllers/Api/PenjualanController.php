<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk;
use App\Models\Penjualan;
use DB;
use Exception;

class PenjualanController extends Controller
{
    public function index() {
        $data = Penjualan::where('user_id', $request->user_id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'no_resi' => 'required',
            'jumlah' => 'required',
            'tgl_pesenan' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ], 500);
        }

        DB::beginTransaction(); 

        $produk = Produk::where('name', 'like', '%'.request->produk_name.'%')->first();
        
        DB::beginTransaction();
        try {

            $user = Auth::guard('api')->check();
            if ($user)
            {

            }

            $penjualan = new Penjualan;
            $penjualan->nama_pelanggan = $request->nama_pelanggan;
            $penjualan->no_hp = $request->no_hp;
            $penjualan->no_resi = $request->no_resi;
            $penjualan->produk_id = $produk->id;
            $penjualan->jumlah = $request->jumlah_produk;
            $penjualan->tgl_pesenan = $request->tgl_pesenan;
            $penjualan->harga = $request->harga;
            
            $penjualan->save();
            
            // dd($penjualan);
                if ($penjualan->save()) {
                    $nama_produk = $penjualan->nama_product;
                    $produk = Produk::findOrFail($penjualan->produk_id)->first();
                    $produk->update([
                        'jml_keluar' => +$penjualan->jumlah_produk, 
                    ]);

                }

                $response = [
                    'status' => 'success',
                    'data' => [
                        'penjualan' => $penjualan,
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
            'produk_id' => 'required',
            'jumlah' => 'required',
            'tgl_pesenan' => 'required',
            'harga' => 'required',
        ],[
            'produk_id.required' => 'Nama Produk tidak boleh kosong !'
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
                'produk_id' => $request->product_id,
                'jumlah' => $request->jumlah,
                'tgl_pesenan' => $request->tgl_pesenan,
                'harga' => $request->harga,
                
            ]);

                $penjualan->update();

                $response = [
                    'status' => 'success',
                    'data' => [
                        'penjualan' => $penjualan,
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
