@extends('layout.admin')
@section('title', 'Pembelian Barang')
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Pembelian Produk</h1>
        </div>

        <form method="POST" action="{{ route('admin.pembelian-create') }}">
            @csrf

            <div class="field_wrapper">
                <div class="form-group">
                    <h5>Pemasok</h5>
                    @foreach ($pemasok as $row)
                    <div class="col-md-6">
                        <select class="form-control" id="nama_produk" name="pemasok_id">
                            <option value="">-- Nama Pemasok --</option>
                            <option value="{{ $row->id }}">{{ $row->nama_pemasok }}</option>
                        </select>
                        @error('pemasok_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endforeach
                    <h5 class="mt-5">Produk</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="nama_produk" name="nama_produk[]">
                                <option value="">-- Nama Produk --</option>
                                @foreach ($produk as $row)
                                    <option value="{{ $row->nama_produk }}">{{ $row->nama_produk }}</option>
                                    @endforeach
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        <div class="col-md-4">
                            <input class="form-control" placeholder="Jumlah" type="number" name="jumlah[]"
                                value="" />
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success" href="javascript:void(0);" id="add_button"
                                title="Add field">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </form>

    </div>
@endsection

@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="form-group add"><div class="row">';
            fieldHTML = fieldHTML +
                '<div class="col-md-6"> <select class="form-control" id="nama_produk" name="nama_produk[]"> <option value="">-- Nama Produk --</option> @foreach ($produk as $row) <option value="{{ $row->nama_produk }}">{{ $row->nama_produk }}</option> @endforeach</select> @error('produk_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror </div>';
            fieldHTML = fieldHTML +
                '<div class="col-md-4"><input class="form-control" placeholder="Jumlah" type="number" name="jumlah[]" /></div>';
            fieldHTML = fieldHTML +
                '<div class="col-md-2"><a href="javascript:void(0);" class="remove_button btn btn-danger">Hapus</a></div>';
            fieldHTML = fieldHTML + '</div></div>';
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('').parent('').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endpush
