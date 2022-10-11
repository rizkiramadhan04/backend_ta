@extends('layout.admin')
@section('title', 'Input Stok Produk')
@section('content')

    <div class="container-fluid">
         <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Input Stok Produk</h1>
            {{-- <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#import">
                <i class="fas fa-plus fa-sm text-white-50"></i> Import
            </a> --}}
        </div>

        <div class="text-center">
            <div class="btn-group btn-group-toggle mt-2 mb-5 shadow" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
                <a href="{{ route('admin.input-stock-produk') }}" style="text-decoration: none; color: white;">
                    <input type="radio" name="options" id="option2" checked> Input Stok Satuan
                </a>
            </label>
            <label class="btn btn-outline-secondary">
                <a href="{{ route('admin.input-riwayat-pembelian') }}" style="text-decoration: none; color: black;">
                    <input type="radio" name="options" id="option3"> Input Produk Masuk
                </a>
            </label>
            </div>
        </div>

        <form action="{{ route('admin.update-stock') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama_produk">Nama Produk</label>
                <select class="form-control @error('produk_id') is-invalid @enderror" id="nama_produk" name="produk_id">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($list_produk as $row)
                        <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>
                    @endforeach
                </select>
                @error('produk_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-3 col-md-6">
                <label for="stock">Stock Sebelumnya *</label>
                <input type="number" class="form-control" id="stock-sblm" name="stock-sblm" disabled>
            </div>
            <div class="form-group col-xl-3 col-md-6">
                <label for="stock">Input Stock *</label>
                <input type="number" class="form-control @error('input_stock') is-invalid @enderror" id="input-stock"
                    name="input_stock">
                @error('input_stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-6">
                <label for="Tanggal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control @error('tgl_produk_masuk') is-invalid @enderror"
                    id="tanggal_barang_masuk" name="tgl_produk_masuk">
                @error('tgl_produk_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary" width="50" height="70">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            // console.log($('#nama_produk').val());
            $('#nama_produk').on('change', function() {

                $.ajax({
                    url: "{{ url('/admin/stock-produk-list') }}",
                    method: "POST",
                    data: {
                        produk_id: $('#nama_produk').val()
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.total > 0) {
                            $('#stock-sblm').val(data.total);
                        } else {
                            $('#stock-sblm').val(0);
                        }
                    }
                });
            })
        });
    </script>
@endpush
