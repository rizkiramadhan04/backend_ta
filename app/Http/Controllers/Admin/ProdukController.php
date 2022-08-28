<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index() {

        $items = Produk::all();

        return view('admin.produk.index', [
            'item' => $items
        ]);
    }

    public function createPage() {
        return view('admin.produk.create');
    }

    public function updatePage() {
        return view('admin.produk.update');
    }
}
