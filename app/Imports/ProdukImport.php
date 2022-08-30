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
        $date_d = $row[2];
        $date_s = str_replace('/', '-', $date_d);

        return new Produk([
            'nama_product' => $row[0],
            'jml_masuk' => $row[1],
            'tgl_produk_masuk' => date("Y-m-d", strtotime($date_s)),
            'harga_jual' => $row[3],
            'harga_beli' => $row[4],
            'jml_keluar' => $row[5],
            'total' => ($row[1] - $row[5]),
        ]);
    }
}
