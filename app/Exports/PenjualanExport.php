<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenjualanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $penjualan = Penjualan::select('penjualans.*', 'produks.nama_produk as nama_produk')->join('produks', 'produks.id', '=', 'penjualans.produk_id')->get();;
        return view('admin.exports.penjualan_export', [
            'model' => $penjualan,
        ]);
    }
}
