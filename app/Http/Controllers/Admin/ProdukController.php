<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index() {

        $items = Produk::all();

        return view('admin.produk.index', [
            'item' => $items
        ]);
    }

    public function createPage() {
        return view('admin.produk.create');
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_product' => 'required|string|max:225',
            'jml_masuk' => 'required|integer',
            'tgl_produk_masuk' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.update-update-page')->withInput()->withErrors($validator);
        }

     $produk = new Produk();
     $produk->nama_product = $request->nama_product;
     $produk->jml_masuk = $request->jml_masuk;
     $produk->tgl_produk_masuk = $request->tgl_produk_masuk;
     $produk->harga_jual = $request->harga_jual;
     $produk->harga_beli = $request->harga_beli;
     $produk->jml_keluar = 0;
     $produk->total = $produk->jml_masuk - $produk->jml_keluar;

     $produk->save();

     if ($produk->save()) {
        return redirect(route('admin.produk'));
     }

    }

    public function updatePage() {
        return view('admin.produk.update');
    }

    public function delete(Request $request, $id) {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()->route('admin.produk');
    }
}
