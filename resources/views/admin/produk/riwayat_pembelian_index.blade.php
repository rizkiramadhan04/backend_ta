@extends('layout.admin')
@section('title', 'Data Produk')
@section('content')
    <div class="text-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Riwayat Produk Masuk</h1>
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
                            <th>Nama Pemasok</th>
                            <th>Tgl Barang Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($items as $obj)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $obj->nama_pemasok }}</td>
                                <td>{{ $obj->tgl_produk_masuk }}</td>
                                <td>
                                    <a href="#" class="btn btn-info" onClick="getDataDetail({{  $obj->id }})" data-toggle="modal" data-target="#staticBackdrop">
                                        <i class="fa-solid fa-circle-info"></i>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Detail Data Pembelian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Nama Pemasok :</p>
            <p id="nama-pemasok"></p>
            <p>Tanggal Produk Masuk :</p>
            <p id="tgl_produk_masuk"></p>
            <br>
            <hr>
            <table class="table text-center" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
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

        function getDataDetail(id) {
            // console.log(id);
            $.ajax({
                url: "{{ url('/admin/detail-riwayat') }}",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log("Data idnya adalah : ", data);
                    // if (data.id == '') {
                    //     $('.modal').modal('hide');
                    // } else {
                    //     $('#nama-pemasok').append(data.pemasok_id);
                    //     $('#tgl_produk_masuk').append(data.tgl_produk_masuk);
                    // }
                    // if (data.total > 0) {
                    //     $('#stock-sblm').val(data.total);
                    // } else {
                    //     $('#stock-sblm').val(0);
                    // }
                }
            });
        }
    </script>
@endpush
