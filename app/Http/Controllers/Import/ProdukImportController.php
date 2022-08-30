<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ProdukImport;
use App\Exports\ProdukExport;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ProdukImportController extends Controller
{
    public function import(Request $request) {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        //request data file
        $file = $request->file('file');

        //penamaan file untuk dilocal
        $nama_file = $file->hashName();

        //penyimpanan local
        $path = $file->storeAs('public/excel/', $nama_file);

        //import data
        $import = Excel::import(new ProdukImport(), $file);

        //delete from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('admin.produk')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('admin.produk')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function export() {
        return Excel::download(new ProdukExport(), 'data_produk.xlsx');
    }
}
