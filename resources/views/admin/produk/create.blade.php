@extends('layout.admin')
@section('title', 'Tambah Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        </div>
        <form action="{{ route('admin.create-produk') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="">Nama Produk</label>
                <input type="text" class="form-control" id="name_produk" aria-describedby="nameProduk" name="nama_product">
                <small id="nameProduk" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="jml-jual" name="jml_masuk">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Harga Jual</label>
                <input type="number" class="form-control" id="harga-jual" name="harga_jual">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-beli">Harga beli</label>
                <input type="number" class="form-control" id="harga-beli" name="harga_beli">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control" id="Tangal Barang Masuk" name="tgl_produk_masuk">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
