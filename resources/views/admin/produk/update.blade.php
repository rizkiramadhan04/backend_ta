@extends('layout.admin')
@section('title', 'Ubah Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Produk</h1>
        </div>

        <form action="{{ route('admin.update-produk', $produk->id) }}" method="POST">
            {{-- @method('PUT') --}}
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama-produk">Nama Produk</label>
                <input type="text" class="form-control" id="name_produk" aria-describedby="nameProduk" name="nama_product"
                    value="{{ $produk->nama_product }}">
                <small id="nameProduk" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="stock-awal"></label>Stock Masuk
                <input type="number" class="form-control" id="stock-masuk" name="jml_masuk"
                    value="{{ $produk->jml_masuk }}">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="stock-keluar">Stock Keluar</label>
                <input type="number" class="form-control" id="stock-keluar" name="jml_keluar"
                    value="{{ $produk->jml_keluar }}">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Harga Jual</label>
                <input type="number" class="form-control" id="harga-jual" name="harga_jual"
                    value="{{ $produk->harga_jual }}">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-beli">Harga beli</label>
                <input type="number" class="form-control" id="harga-beli" name="harga_beli"
                    value="{{ $produk->harga_beli }}">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control" id="Tangal Barang Masuk" name="tgl_produk_masuk"
                    value="{{ $produk->tgl_produk_masuk }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
@endsection
