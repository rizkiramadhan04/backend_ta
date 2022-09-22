<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index() {
        return view('admin.suplier.index');
    }

    public function createPage() {
        return view('admin.suplier.create');
    }

    public function pembelian() {
        return view('admin.suplier.pembelian');
    }
}
