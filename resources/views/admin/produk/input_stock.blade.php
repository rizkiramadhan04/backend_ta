@extends('layout.admin')
@section('title', 'Tambah Produk')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.create-produk') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama_produk">Nama Produk</label>
                <select class="form-control" id="nama_produk">
                    @foreach ($list_produk as $row)
                        <option value="{{ $row->id }}">{{ $row->nama_product }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-xl-3 col-md-3">
                <label for="stock">Stock Sebelumnya *</label>
                <input type="number" class="form-control" id="stock-sblm" name="stock-sblm">
            </div>
            <div class="form-group col-xl-3 col-md-3">
                <label for="stock">Input Stock *</label>
                <input type="number" class="form-control" id="input-stock" name="input-stock" value="">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="Tangal Barang Masuk">Tangal Barang Masuk</label>
                <input type="date" class="form-control" id="Tangal Barang Masuk" name="tgl_produk_masuk">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            $('#nama_produk').on('change', function() {

                $.ajax({
                    url: "{{ route('admin.get-stock-product') }}",
                    method: "POST",
                    data: {
                        produk_id: $('#nama_produk').val()
                    },
                }).done(function(values) {
                    if (msg.error == 0) {
                        //$('.sucess-status-update').html(msg.message);
                        alert(msg.message);
                    } else {
                        alert(msg.message);
                        //$('.error-favourite-message').html(msg.message);
                    }
                })
            })
        });
    </script>
@endpush
