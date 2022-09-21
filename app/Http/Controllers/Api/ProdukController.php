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

        // $user = auth()->guard('api')->user()->id;
        
        $produk = Produk::all();

        if ($produk) {
            $response = [
                'status'    => 'success',
                'data'      => $produk,
            ];
        } else {
            $response = [
                'status'    => 'failed',
                'data'      => [],
                'message'   => 'Data tidak ada !'
            ];
        }

        return response()->json($response, 200);
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_produk'       => 'required|string|max:225',
            'jml_masuk'         => 'required|integer|max:225',
            'jml_keluar'        => 'required|integer|max:225',
            'total'             => 'required|integer|max:225',
            'tgl_produk_masuk'  => 'required',
            'harga_jual'        => 'required|integer|max:225',
            'harga_beli'        => 'required|integer|max:225',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'    => 'faied',
                'messages'  => $validator->errors(),
            ];

        }

        $time = strtotime($request->tgl_produk_masuk);
        $tgl_produk_masuk = date("Y-m-d", $time);
        
        DB::beginTransaction();
        try {
            
            $produk = new Produk;
            $produk->nama_produk        = $request->nama_produk;
            $produk->jml_masuk          = $request->jml_masuk;
            $produk->jml_keluar         = $request->jml_keluar;
            $produk->total              = ($request->jml_masuk - $request->jml_keluar);
            $produk->tgl_produk_masuk   = $tgl_produk_masuk;
            $produk->harga_jual         = $request->harga_jual;
            $produk->harga_beli         = $request->harga_beli;
    
            $produk->save();

            $response = [
            'status'            => 'success',
            'id'                => $produk->id,
            'nama_produk'       => $produk->nama_produk,
            'jml_masuk'         => $produk->jml_masuk,
            'jml_keluar'        => $produk->jml_keluar,
            'tgl_produk_masuk'  => date("d-m-Y", strtotime($produk->tgl_produk_masuk)),
            'harga_jual'        => $produk->harga_jual,
            'harga_beli'        => $produk->harga_beli,
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

    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'id'                => 'required',
            'nama_produk'       => 'required|string|max:225',
            'tgl_produk_masuk'  => 'required',
            'harga_jual'        => 'required|integer|max:225',
            'harga_beli'        => 'required|integer|max:225',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'    => 'failed',
                'messages'  => $validator->errors()->first(),
            ];
        }

        $produk = Produk::whereId($request->input('id'))->first();
        $time = strtotime($request->tgl_produk_masuk);
        $tgl_produk_masuk = date("Y-m-d", $time);
        
        DB::beginTransaction();
        try {
            
            $produk->update([
                'nama_produk'       => $request->input('nama_produk'),
                'tgl_produk_masuk'  => $tgl_produk_masuk,
                'harga_jual'        => $request->input('harga_jual'),
                'harga_beli'        => $request->input('harga_beli'),
            ]);

            $response = [
            'status'            => 'success',
            'id'                => $produk->id,
            'nama_produk'       => $produk->nama_produk,
            'jml_masuk'         => $produk->jml_masuk,
            'jml_keluar'        => $produk->jml_keluar,
            'tgl_produk_masuk'  => date("d-m-Y", strtotime($produk->tgl_produk_masuk)),
            'harga_jual'        => $produk->harga_jual,
            'harga_beli'        => $produk->harga_beli,
            ];

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            
            $response = [
                'status'    => 'failed',
                'messages'  => $e->getMessage(),
            ];
        }

        return response()->json($response, 200);
    }

    public function updateStok(Request $request) {
        $validator = Validator::make($request->all(), [
            'produk_id'     => 'required',
            'input_stok'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 'success',
                'message'   => $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try {

            $produk = Produk::find($request->produk_id);

            if ($produk) {
    
                $produk->update([
                    'jml_masuk' => ($request->input('input_stok') + $produk->jml_keluar),
                ]);

                DB::commit();

                $response = [
                    'status'    => 'success',
                    'message'   => 'Update Stok Berhasil !',
                ];    
            } else {
                $response = [
                    'status'    => 'failed',
                    'message'   => 'Produk tidak ada !',
                ];    
            }

        } catch (Exception $e) {

            DB::rollback();

            $response = [
                'status'    => 'failed',
                'message'   => $e->getMessage(),
            ]; 
        }

        return response()->json($response, 200);

    }

    public function delete(Request $request) {

        $produk = Produk::find($request->id);
        // dd($produk);
        if ($produk) {

            $produk->delete();

            $response = [
                'status'    => 'success',
                'message'   => 'Hapus Data Berhasil !',
            ];    

        } else {
            $response = [
                'status'    => 'Failed',
                'message'   => 'Data Produk Tidak ada !',
            ];   
        }

        return response()->json($response, 200);
    }
}
