<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Produk;
use App\Models\Pemasok;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class pemasokController extends Controller
{
    public function index() {
        $items = pemasok::all();

        return view('admin.pemasok.index', compact('items'));
    }

    public function createPage() {
        return view('admin.pemasok.create');
    }

    public function create(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'nama_pemasok'   => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'kategori'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pemasok.create')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $model = new Pemasok;
            $model->nama_pemasok = $request->nama_pemasok;
            $model->alamat       = $request->alamat;
            $model->no_hp        = $request->no_hp;
            $model->kategori     = $request->kategori;
            $model->save();

            DB::commit();
            
            return redirect()->route('admin.pemasok');

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->route('admin.pemasok.create')->withErrors($e->getMessage())->withInput();

        }
    }

    public function getProduk(Request $request) {
        $produk = Produk::where('pemasok_id', $request->pemasok_id)->pluck('nama_produk', 'id');

        return response()->json($produk);

    }

    public function pembelian(Request $request) {
        $pemasok = Pemasok::all();
        $produk  = Produk::all();
        return view('admin.pemasok.pembelian', compact('pemasok', 'produk'));
    }

    public function save(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'pemasok_id'        => 'required',
            'nama_produk'       => 'required',
            'jumlah'            => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pemasok-pembelian')->withErrors($validator)->withInput();
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
            $pembelian->pemasok_id    = $request->pemasok_id;
            $pembelian->nama_produk     = $produk;
            $pembelian->jumlah        = $jml;
            $pembelian->save();
            }


        DB::commit();

        return redirect()->route('admin.pemasok.pembelian-index');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.pemasok-pembelian')->withErrors($e->getMessage())->withInput();
        }
    }

    public function exportPdf($id) {
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            $nama_produk    = $pembelian->nama_produk;
            $jml            = $pembelian->jumlah;

            $produk = explode(',', $nama_produk);
            $jumlah = explode(',', $jml);
            $count_produk = count($produk);
            $nama_pemasok = Pemasok::where('id', $pembelian->pemasok_id)->first();
            
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
        $items = Pembelian::select('pembelian_produks.*', 'pemasoks.nama_pemasok as nama_pemasok')->join('pemasoks', 'pembelian_produks.pemasok_id', '=', 'pemasoks.id')->get();

       
        return view('admin.pemasok.pembelian-index', compact('items'));
    }
}
