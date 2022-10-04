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

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'suplier_id'        => 'required',
            'nama_produk'         => 'required',
            'jumlah'            => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.suplier-pembelian')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

           $nama_produk = array($request->nama_produk);
           $jumlah = array($request->jumlah);
           $total = count($nama_produk);

           
           for($i = 0; $i < $total; $i++){

                $produk = implode(',', $nama_produk[$i]);
                $jml = implode(',', $jumlah[$i]);

       
            $pembelian = new Pembelian;
            $pembelian->suplier_id    = $request->suplier_id;
            $pembelian->nama_produk     = $produk;
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

    public function exportPdf($id) {
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            $nama_produk = $pembelian->nama_produk;
            $jml = $pembelian->jumlah;

            $produk = explode(',', $nama_produk);
            $jumlah = explode(',', $jml);
            $count_produk = count($produk);
            $nama_pemasok = Suplier::where('id', $pembelian->suplier_id)->first();
            
            $data = [
                'nama_produk' => $produk,
                'jumlah' => $jumlah,
            ];
            // dd($pembelian->created_at);

            $pdf   = PDF::loadview('admin.exports.pembelian_pdf', ['count_produk' => $count_produk, 'nama_pemasok' => $nama_pemasok, 'nama_produk' => $produk, 'jumlah' => $jumlah]);
        }
        return $pdf->download('pemesanan_produk_('.date('d-m-Y', strtotime($pembelian->created_at)).').pdf');
    }

    public function pembelianPage() {
        $items = Pembelian::all();

        foreach ($items as $row) {
            
            $suplier = Suplier::where('id', $row->suplier_id)->first();
            
            $nama_pemasok = $suplier->nama_suplier;
        }


        return view('admin.suplier.pembelian-index', compact('items', 'nama_pemasok'));
    }
}
