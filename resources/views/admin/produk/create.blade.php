@extends('layout.admin')
@section('title', 'Tambah Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
            <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#import">
                <i class="fas fa-plus fa-sm text-white-50"></i> Import
            </a>
        </div>
        <form action="{{ route('admin.create-produk') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="">Nama Produk</label>
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="name_produk"
                    aria-describedby="nameProduk" name="nama_produk">
                @error('nama_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('jml_masuk') is-invalid @enderror" id="jml-jual"
                    name="jml_masuk">
                @error('jml_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-jual">Harga Jual</label>
                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga-jual"
                    name="harga_jual">
                @error('harga_jual')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="harga-beli">Harga beli</label>
                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga-beli"
                    name="harga_beli">
                @error('harga_beli')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control @error('tgl_produk_masuk') is-invalid @enderror"
                    id="Tangal Barang Masuk" name="tgl_produk_masuk">
                @error('tgl_produk_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="pemasok_id">Nama Pemasok</label>
                <select class="form-control @error('produk_id') is-invalid @enderror" id="pemasok_id" name="pemasok_id">
                    <option value="">-- Pilih Pemasok --</option>
                    @foreach ($nama_pemasok as $row)
                        <option value="{{ $row->id }}">{{ $row->nama_pemasok }}</option>
                    @endforeach
                </select>
                @error('pemasok_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
        </form>

        {{-- modal --}}
        <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">IMPORT DATA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.produk.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>PILIH FILE</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                            <button type="submit" class="btn btn-success">IMPORT</button>
                        </div>
                    </form>
                    <a href="{{ asset('imports/template_data_poduk.xlsx') }}"><button
                            class="btn btn-primary mb-3 ml-3">Download Template Excel</button></a>
                </div>
            </div>
        </div>

    </div>
@endsection
