@extends('layout.admin')
@section('title', 'Ubah Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Produk</h1>
        </div>
        <form>
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama-produk">Nama Produk</label>
                <input type="text" class="form-control" id="name_produk" aria-describedby="nameProduk">
                <small id="nameProduk" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual"></label>Stock Saat Ini
                <input type="number" class="form-control" id="harga-jual">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Stock Masuk</label>
                <input type="number" class="form-control" id="harga-jual">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Harga Jual</label>
                <input type="number" class="form-control" id="harga-jual">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-beli">Harga beli</label>
                <input type="number" class="form-control" id="harga-beli">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control" id="Tangal Barang Masuk">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
