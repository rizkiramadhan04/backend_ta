<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        ],[
            'nama_product.required' => 'Nama produk belum terisi',
            'jml_masuk.required' => 'Jumlah stock belum terisi',
            'tgl_produk_masuk.required' => 'Tanggal masuk produk belum terisi',
            'harga_jual.required' => 'Harga jual belum terisi',
            'harga_beli.required' => 'Harga beli belum terisi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.create-produk-page')->withInput()->withErrors($validator);
        }
        
        DB::beginTransaction();
     try {
        $produk = new Produk();
        $produk->nama_product = $request->nama_product;
        $produk->jml_masuk = $request->jml_masuk;
        $produk->tgl_produk_masuk = $request->tgl_produk_masuk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->jml_keluar = 0;
        $produk->total = $produk->jml_masuk - $produk->jml_keluar;

        $produk->save();
        DB::commit();

        return redirect()->route('admin.produk');

     } catch (Exception $e) {
        DB::rollBack();

        return redirect()->route('admin.create-produk-page')->withErrors($e->getMessage())->withInput();
     }

    }

    public function inputPage() {

        $list_produk = DB::table('produks')->get();
        return view('admin.produk.input_stock', compact('list_produk'));
    }

    public function getStockProduct(Request $request) {
        $produk_stock = DB::table('produks')->where('id', $request->produk_id)->first();
        return response()->json($produk_stock);
    }

    public function updateStock(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
            'input_stock' => 'required',
            'tgl_produk_masuk' => 'required',
        ],[
            'produk_id.required' => 'Nama produk belum dipilih',
            'input_stock.required' => 'Stock belum diisi',
            'tgl_produk_masuk.required' => 'Tanggal produk masuk belum diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.input-stock-produk')->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {

            $produk = Produk::findOrFail($request->produk_id);
            $total = ($produk->total + $request->jml_masuk);
            // dd($total);

            $produk->update([
            'jml_masuk' => $request->input_stock,
            'tgl_produk_masuk' => $request->tgl_produk_masuk,
            'total' => $total,
            ]);

            DB::commit();

            return redirect()->route('admin.produk');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.input-stock-produk')->withErrors($e->getMessage());
        }
    }

    public function updatePage($id) {
        $produk = Produk::where('id', $id)->first();
        return view('admin.produk.update', compact('produk'));
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'nama_product' => 'required|string|max:225',
            'tgl_produk_masuk' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ],[
            'nama_product.required' => 'Nama produk belum diisi',
            'tgl_produk_masuk.required' => 'Tanggal produk masuk belum diisi',
            'harga_jual.required' => 'Harga jual produk belum diisi',
            'harga_beli.required' => 'Harga beli produk belum diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.update-produk-page', $id)->withErrors($validator)->withInput();
        }

        $produk = Produk::findOrFail($id);

        DB::beginTransaction();
        try {
            $produk->update([
                'nama_product' => $request->nama_product,
                'tgl_produk_masuk' => $request->tgl_produk_masuk,
                'harga_jual' => $request->harga_jual,
                'harga_beli' => $request->harga_beli,
                'jml_keluar' => $request->jml_keluar,
            ]);

            DB::commit();
            return redirect()->route('admin.produk');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.update-produk-page')->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request) {

        $produk = Produk::findOrFail($request->id);
        $produk->delete();

        return redirect()->route('admin.produk');
    }
}
