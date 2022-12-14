@extends('layout.admin')
@section('title', 'Data User')
@section('content')
    <div class="text-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pemasok</h1>
            <a href="{{ route('admin.pemasok-create-page') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pemasok Baru
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Hp / Telepon</th>
                            <th>Kategori Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $items as $row )
                        @php
                            $no = 1;
                        @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_pemasok }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td>
                                    <a href="#" class="btn btn-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="#" method="post"
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
