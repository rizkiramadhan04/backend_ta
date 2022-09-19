@extends('layout.admin')
@section('title', 'Data Produk')
@section('content')
    <div class="text-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
            <a href="{{ route('admin.produk.export') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Export
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stock Saat Ini</th>
                            <th>Jumlah yang Keluar</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Tgl Barang Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($item as $obj)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $obj->nama_produk }}</td>
                                <td>{{ ($obj->jml_masuk - $obj->jml_keluar) }}</td>
                                <td>{{ $obj->jml_keluar }}</td>
                                <td>{{ $obj->harga_beli }}</td>
                                <td>{{ $obj->harga_jual }}</td>
                                <td>{{ $obj->tgl_produk_masuk }}</td>
                                <td>
                                    <a href="{{ route('admin.update-produk-page', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.delete-produk', $obj->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @empty
                            <tr>
                                <td colspan="8">Data Masih Kosong !!</td>
                            </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
