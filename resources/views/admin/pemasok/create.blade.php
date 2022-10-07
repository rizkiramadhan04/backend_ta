@extends('layout.admin')
@section('title', 'Tambah User')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pemasok</h1>
        </div>
        <form action="{{ route('admin.pemasok-create') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama_pemasok">Nama Pemasok</label>
                <input type="text" class="form-control @error('nama_pemasok') is-invalid @enderror" id="nama_pemasok"
                    name="nama_pemasok">
                @error('nama_pemasok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="alamat">Alamat</label>
                <input type="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                    name="alamat">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="no_hp">No Hp / Telepon</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                    name="no_hp">
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="kategori">Kategori Produk</label>
                <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                    name="kategori">
                @error('kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
        </form>
    </div>
@endsection
