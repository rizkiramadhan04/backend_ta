@extends('layout.admin')
@section('title', 'Input Produk Masuk')
@section('content')

    <div class="container-fluid">
        {{-- <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Input Produk Masuk</h1>
        </div>

         <div class="text-center">
            <div class="btn-group btn-group-toggle mt-2 mb-5 shadow" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
                <a href="{{ route('admin.input-stock-produk') }}" style="text-decoration: none; color: black;">
                    <input type="radio" name="options" id="option2"> Input Stok Satuan
                </a>
            </label>
            <label class="btn btn-outline-secondary">
                <a href="{{ route('admin.input-riwayat-pembelian') }}" style="text-decoration: none; color: white;">
                    <input type="radio" name="options" id="option3" checked> Input Produk Masuk
                </a>
            </label>
            </div>
        </div> --}}

        <form method="POST" action="{{ route('admin.save-riwayat') }}">
            @csrf

            <div class="field_wrapper">
                <div class="form-group">
                    <label for="nama_pemasok">Nama Pemasok</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('nama_pemasok') is-invalid @enderror" id="nama_pemasok"
                    aria-describedby="nameProduk" name="nama_pemasok" value="{{ $nama_pemasok }}">
                        @error('nama_pemasok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="tgl_produk_masuk" class="mt-3">Tanggal Produk Masuk</label>
                    <div class="col-md-6">
                    <input class="form-control" type="date" name="tgl_produk_masuk" value="{{ $tanggal_masuk }}"/>
                        @error('tgl_produk_masuk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    
                    @php
                    $no = 1;
                    @endphp
                        <h6 class="mt-5">Data Produk</h6>
                    <?php for($i=0; $i < $count_data; $i++) {?>
                    
                    <div class="row">
                        <div class="col-md-6 mt-3">
                               <input class="form-control" placeholder="Nama Produk" type="text" name="nama_produk[]"
                                value="{{ $nama_produk[$i] }}" />
                                @error('nama_produk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        <div class="col-md-4 mt-3">
                            <input class="form-control" placeholder="Jumlah" type="number" name="jumlah[]"
                                value="{{ $jumlah[$i] }}" />
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success mt-3" href="javascript:void(0);" id="add_button"
                                title="Add field">Tambah</a>
                        </div>
                    </div>
                    
                    <?php } ?>

                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Simpan</button>
        </form>

    </div>
@endsection

{{-- @push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="form-group add"><div class="row">';
            fieldHTML = fieldHTML +
                '<div class="col-md-6"> <select class="form-control" id="nama_produk" name="nama_produk[]"> <option value="">-- Nama Produk --</option> @foreach ($produk as $row) <option value="{{ $row->nama_produk }}">{{ $row->nama_produk }}</option> @endforeach</select> @error('nama_produk') <div class="invalid-feedback"> {{ $message }} </div> @enderror </div>';
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
@endpush --}}
