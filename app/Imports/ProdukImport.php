<?php

namespace App\Imports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $date_d = $row['tgl_produk_masuk'];
        $date_s = str_replace('/', '-', $date_d);

        return new Produk([
            'nama_product' => $row['nama_produk'],
            'jml_masuk' => $row['jml_masuk'],
            'tgl_produk_masuk' => date("Y-m-d", strtotime($date_s)),
            'harga_jual' => $row['harga_jual'],
            'harga_beli' => $row['harga_beli'],
            'jml_keluar' => $row['jml_keluar'],
            'total' => ($row['jml_masuk'] - $row['jml_keluar']),
        ]);
    }
}
