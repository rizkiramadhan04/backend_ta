<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Suplier;

class SuplierController extends Controller
{
    public function index() {
        $items = Suplier::all();

        return view('admin.suplier.index', compact('items'));
    }

    public function createPage() {
        return view('admin.suplier.create');
    }

    public function create(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'nama_suplier'   => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'kategori'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.suplier.create')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $model = new Suplier;
            $model->nama_suplier = $request->nama_suplier;
            $model->alamat       = $request->alamat;
            $model->no_hp        = $request->no_hp;
            $model->kategori     = $request->kategori;
            $model->save();

            DB::commit();
            
            return redirect()->route('admin.suplier');

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->route('admin.suplier.create')->withErrors($e->getMessage())->withInput();

        }
    }

    public function pembelian() {
        return view('admin.suplier.pembelian');
    }
}
