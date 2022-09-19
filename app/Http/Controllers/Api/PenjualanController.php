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
            'produk_id' => 'required',
            'jumlah' => 'required',
            'tgl_pesanan' => 'required',
            'harga' => 'required',
        ]);

        // dd($validator->fails());
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ], 500);
        }

        DB::beginTransaction(); 

        $produk = Produk::where('nama_produk', 'LIKE', '%' .$request->produk_name. '%');
        
        DB::beginTransaction();
        try {
            // dd($request->all());
            // $user = Auth::guard('api')->check();
            // if ($user)
            // {

            // }

            $penjualan = new Penjualan;
            $penjualan->nama_pelanggan = $request->nama_pelanggan;
            $penjualan->no_hp = $request->no_hp;
            $penjualan->no_resi = $request->no_resi;
            $penjualan->produk_id = $request->produk_id;
            $penjualan->jumlah = $request->jumlah;
            $penjualan->tgl_pesanan = $request->tgl_pesanan;
            $penjualan->harga = $request->harga;
            
            $penjualan->save();
            
            // dd($penjualan->save());
                if ($penjualan->save()) {
                    $produk = Produk::where('id', $penjualan->produk_id)->update([
                        'jml_keluar' => +$penjualan->jumlah, 
                    ]);

                }

                $response = [
                    'status' => 'success',
                    'data' => $penjualan,
                ];
                DB::commit();

                } catch (Exception $e) {

                    DB::rollback();

                    $response = [
                        'status' => 'failed',
                        'message' => $e->getMessage(),
                    ];
        }

        return response()->json($response);
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
