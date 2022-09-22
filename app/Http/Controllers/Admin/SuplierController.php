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

    public function create(Request $request) {

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
            $model->Alamat       = $request->alamat;
            $model->ho_hp        = $request->ho_hp;
            $model->kategori     = $request->kategori;
            $model->save();

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->route('admin.suplier.create')->withErrors($e->getMessage())->withInput();

        }
    }

    public function pembelian() {
        return view('admin.suplier.pembelian');
    }
}
