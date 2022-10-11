<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Pemasok;
use App\Models\ProdukMasuk;
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
        $nama_pemasok = Pemasok::all();

        return view('admin.produk.create', compact('nama_pemasok'));
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:225',
            'jml_masuk' => 'required|integer',
            'tgl_produk_masuk' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ],[
            'nama_produk.required' => 'Nama produk belum terisi',
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
        $produk->nama_produk = $request->nama_produk;
        $produk->jml_masuk = $request->jml_masuk;
        $produk->tgl_produk_masuk = $request->tgl_produk_masuk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->jml_keluar = 0;
        $produk->total = $produk->jml_masuk - $produk->jml_keluar;
        $produk->pemasok_id = $request->pemasok_id;

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
            // dd($request->all());

            $produk = Produk::findOrFail($request->produk_id);
            $total = ($produk->total + $request->input_stock);


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
            'nama_produk' => 'required|string|max:225',
            'tgl_produk_masuk' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ],[
            'nama_produk.required' => 'Nama produk belum diisi',
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
                'nama_produk' => $request->nama_produk,
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

    public function riwayat() {
        $items = ProdukMasuk::select('produk_masuks.*', 'pemasoks.nama_pemasok as nama_pemasok')->join('pemasoks', 'produk_masuks.pemasok_id', '=', 'pemasoks.id')->get();
        return view('admin.produk.riwayat_pembelian_index', compact('items'));
    }

    public function riwayatInput() {
        $pemasok = Pemasok::all();
        $produk  = Produk::all();
        return view('admin.produk.input-riwayat', compact('produk', 'pemasok'));
    }

    public function riwayatSave(Request $request) {

        $validator = Validator::make($request->all(), [
            'produk_id'         => 'required',
            'jumlah'            => 'required',
            'tgl_produk_masuk'  => 'required',
            'pemasok_id'        => 'required',
        ],[
            'produk_id.required'            => 'Nama produk tidak boleh kosong',
            'jumlah.required'               => 'Jumlah produk tidak boleh kosong',
            'tgl_produk_masuk.required'     => 'Tanggal tidak boleh kosong',
            'pemasok_id.required'           => 'Nama pemasok tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.produk.input-riwayat')->withErrors($validator->errors())->withInput();
        }

        DB::beginTransaction();
        try {
           $produk      = array($request->produk_id);
           $jumlah      = array($request->jumlah);
           $total       = count($produk);

           for($i = 0; $i < $total; $i++){

            $produk_id     = implode(',', $produk[$i]);
            $jml        = implode(',', $jumlah[$i]);

       
            $produk = new ProdukMasuk;
            $produk->produk_id          = $produk_id;
            $produk->jumlah             = $jml;
            $produk->tgl_produk_masuk   = $request->tgl_produk_masuk;
            $produk->pemasok_id         = $request->pemasok_id;
            $produk->save();

            }
            

            DB::commit();

            return redirect()->route('admin.riwayat-pembelian');

        } catch (Exception $e) {
            
            DB::rollback();
            return redirect()->route()->withErrors($e->getMessage());
        }
    }

    public function riwayatDetail(Request $request) {
        $items = ProdukMasuk::where('id', $request->id)->first();

        return response()->json($items);
    }

    public function delete(Request $request) {

        $produk = Produk::findOrFail($request->id);
        $produk->delete();

        return redirect()->route('admin.produk');
    }
}
