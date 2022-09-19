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
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="name_produk"
                    aria-describedby="nameProduk" name="nama_produk" value="{{ $produk->nama_produk }}">
                @error('nama_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Harga Jual</label>
                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga-jual"
                    name="harga_jual" value="{{ $produk->harga_jual }}">
                @error('harga_jual')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-beli">Harga beli</label>
                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga-beli"
                    name="harga_beli" value="{{ $produk->harga_beli }}">
                @error('harga_beli')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control @error('tgl_produk_masuk') is-invalid @enderror"
                    id="Tangal Barang Masuk" name="tgl_produk_masuk" value="{{ $produk->tgl_produk_masuk }}">
                @error('tgl_produk_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"> Edit Data </button>
        </form>

    </div>
@endsection
