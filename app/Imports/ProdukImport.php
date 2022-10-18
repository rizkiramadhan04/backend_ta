<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Pemasok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukImport implements ToModel, WithHeadingRow
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $date_d         = $row['tgl_produk_masuk'];
        $date_s         = str_replace('/', '-', $date_d);
        $pemasok_id     = Pemasok::where('nama_pemasok', $row['nama_pemasok'])->first();
        $mt_rand        = mt_rand(100000, 999999);
        $kode_produk    = 'TS9-'.$mt_rand;
           
        return new Produk([

            'nama_produk'       => $row['nama_produk'],
            'jml_masuk'         => $row['jml_masuk'],
            'tgl_produk_masuk'  => date("Y-m-d", strtotime($date_s)),
            'harga_jual'        => $row['harga_jual'],
            'harga_beli'        => $row['harga_beli'],
            'jml_keluar'        => $row['jml_keluar'],
            'total'             => ($row['jml_masuk'] - $row['jml_keluar']),
            'pemasok_id'        => $pemasok_id->id,
            'kode_produk'       => $kode_produk,
            
        ]);

    }
}
