<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Produk;
use App\Models\Suplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
    public function index() {
        $items = Suplier::all();

        return view('admin.suplier.index', compact('items'));
    }

    public function createPage() {
        return view('admin.suplier.create');
    }

    public function create(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'nama_suplier'   => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'kategori'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.suplier.create')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $model = new Suplier;
            $model->nama_suplier = $request->nama_suplier;
            $model->alamat       = $request->alamat;
            $model->no_hp        = $request->no_hp;
            $model->kategori     = $request->kategori;
            $model->save();

            DB::commit();
            
            return redirect()->route('admin.suplier');

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->route('admin.suplier.create')->withErrors($e->getMessage())->withInput();

        }
    }

    public function getProduk(Request $request) {
        $produk = Produk::where('suplier_id', $request->suplier_id)->pluck('nama_produk', 'id');

        return response()->json($produk);

    }

    public function pembelian(Request $request) {
        $suplier = Suplier::all();
        $produk  = Produk::all();
        return view('admin.suplier.pembelian', compact('suplier', 'produk'));
    }

    public function save(Request $request) {

        $validator = Validator::make($request->all(), [
            'suplier_id'        => 'required',
            'produk_id'         => 'required',
            'jumlah'            => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.suplier-pembelian')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

           $produk_id = array($request->produk_id);
           $jumlah = array($request->jumlah);
           $total = count($produk_id);

        //    dd($total);
           
           for($i = 0; $i < $total; $i++){
               
                $produk = implode(',', $produk_id[$i]);
                $jml = implode(',', $jumlah[$i]);

            // dd($jml);
       
            $pembelian = new Pembelian;
            $pembelian->suplier_id    = $request->suplier_id;
            $pembelian->produk_id     = $produk;
            $pembelian->jumlah        = $jml;
            $pembelian->save();
        }


        DB::commit();

        return redirect()->route('admin.suplier-pembelian');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.suplier-pembelian')->withErrors($e->getMessage())->withInput();
        }
    }

    public function exportPdf() {
        $items = Pembelian::all();
        $pdf   = PDF::loadview('admin.exports', ['items' => $items]);
        return $pdf->download('laporan-post.pdf');
    }
}
