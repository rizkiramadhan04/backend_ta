@extends('layout.admin')
@section('title', 'Data User')
@section('content')
    <div class="text-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pembelian Produk</h1>
            <a href="{{ route('admin.pemasok-pembelian') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pembelian
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemasok</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($items as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_pemasok }}</td>
                                <td>{{ $row->nama_produk }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>
                                    <?php if ($row->status == 0) { ?>
                                    <span class="badge badge-danger">Belum diterima</span>
                                    <?php } else { ?>
                                    <span class="badge badge-success">Diterima</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pembelian-pdf', $row->id) }}" class="btn btn-info">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('admin.input-riwayat-pembelian', $row->id) }}"
                                        class="btn btn-success">
                                        Terima
                                    </a>

                                    {{-- <form action="#" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form> --}}
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
