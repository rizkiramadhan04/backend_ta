@extends('layout.admin')
@section('title', 'Data Penjualan')
@section('content')
    <div class="text-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>
            <a href="{{ route('admin.penjualan.export') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Export / Import
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>No Resi</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Tanggal Pesan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($item as $obj)
                            <tr>
                                <td>{{ $obj->id }}</td>
                                <td>{{ $obj->nama_pelanggan }}</td>
                                <td>{{ $obj->no_hp }}</td>
                                <td>{{ $obj->no_resi }}</td>
                                <td>{{ $obj->produk_id }}</td>
                                <td>{{ $obj->harga_jumlah }}</td>
                                <td>{{ $obj->harga }}</td>
                                <td>{{ $obj->tgl_pesenan }}</td>
                                <td>
                                    <a href="#" class="btn btn-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="#" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @empty
                            <tr>
                                <td colspan="9">Data Masih Kosong !!</td>
                            </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
