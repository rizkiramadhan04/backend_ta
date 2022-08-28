<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = Penjualan::all();

        return view('admin.penjualan.index', [
            'item' => $penjualan
        ]);
    }
}
