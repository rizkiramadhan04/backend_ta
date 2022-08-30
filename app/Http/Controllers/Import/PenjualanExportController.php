<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;

class PenjualanExportController extends Controller
{
    public function export() {
        return Excel::download(new PenjualanExport(), 'data_penjualan.xlsx');
    }
}
