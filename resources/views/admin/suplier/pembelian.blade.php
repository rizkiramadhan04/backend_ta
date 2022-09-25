@extends('layout.admin')
@section('title', 'Pembelian Barang')
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Pembelian Produk</h1>
        </div>

        <form method="POST" action="{{ route('admin.pembelian-create') }}">
            @csrf

            <div class="form-group col-xl-6 col-md-4">
                <label for="suplier_id">Nama Suplier</label>
                <select class="form-control @error('suplier_id') is-invalid @enderror" id="suplier_id" name="suplier_id">
                    <option value="">-- Pilih Suplier --</option>
                    @foreach ($suplier as $row)
                        <option value="{{ $row->id }}">{{ $row->nama_suplier }}</option>
                    @endforeach
                </select>
                @error('suplier_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group" id="dynamic_form">
                <p>Produk
                <p>
                    @foreach ($produk as $row)
                        <div class="form-group baru-data row">
                            <div class="col-md-3">
                                <select class="form-control" id="nama_produk" name="produk_id">
                                    <option value="">-- Nama Produk --</option>
                                    <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="jumlah" placeholder="Jumlah Produk" class="form-control">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="col-md-3">
                        <select class="form-control">
                            <option value="">- Pilih Kategori -</option>
                            <option value="1">Buku</option>
                            <option value="2">Elektronik</option>
                            <option value="3">Kesehatan</option>
                            <option value="4">Rumah Tangga</option>
                            <option value="5">Mainan Hobi</option>
                            <option value="6">Olahraga</option>
                        </select>
                    </div> --}}
                            {{-- <div class="col-md-3">
		                    <textarea name="deskripsi_produk" placeholder="Deskripsi Produk" class="form-control" rows="1"></textarea>
		                </div> --}}
                            <div class="button-group">
                                <button type="button" class="btn btn-success btn-tambah"><i
                                        class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
            </div>
            <button type="submit" class="btn btn-primary btn-simpan"></i> Buat PDF </button>
        </form>

    </div>
@endsection

@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        function addForm() {
            var addrow = '<div class="form-group baru-data row">\
                                                                    <div class="col-md-3">\
                                                                        <select class="form-control" id="nama_produk">\
                                                                            <option value="">-- Nama Produk --</option>\
                                                                            <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>\
                                                                        </select>\
                                                                        @error('produk_id')\
                                                                            <div class="invalid-feedback">\
                                                                                {{ $message }}\
                                                                            </div>\
                                                                        @enderror\
                                                                    </div>\
                                                                    <div class="col-md-2">\
                                                                        <input type="number" name="jumlah" placeholder="Jumlah Produk" class="form-control">\
                                                                        @error('jumlah')\
                                                                            <div class="invalid-feedback">\
                                                                                {{ $message }}\
                                                                            </div>\
                                                                        @enderror\
                                                                    </div>\
                                                                    <div class="button-group">\
                                                                        <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                                                                        <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
                                                                    </div>\
                                                                    </div>'
            $("#dynamic_form").append(addrow);
        }

        $("#dynamic_form").on("click", ".btn-tambah", function() {
            addForm()
            $(this).css("display", "none")
            var valtes = $(this).parent().find(".btn-hapus").css("display", "");
        })

        $("#dynamic_form").on("click", ".btn-hapus", function() {
            $(this).parent().parent('.baru-data').remove();
            var bykrow = $(".baru-data").length;
            if (bykrow == 1) {
                $(".btn-hapus").css("display", "none")
                $(".btn-tambah").css("display", "");
            } else {
                $('.baru-data').last().find('.btn-tambah').css("display", "");
            }
        });

        // $('.btn-simpan').on('click', function() {
        //     $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
        //         if ($(this).val() == "") {
        //             event.preventDefault()
        //             $(this).css('border-color', 'red');

        //             $(this).on('focus', function() {
        //                 $(this).css('border-color', '#ccc');
        //             });
        //         }
        //     })
        // });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            //ambil data nama data produk berdasarkan toko pemasoknya

            console.log($('#nama_produk').val());
            $('#suplier_id').on('change', function() {

                // console.log($('#suplier_id').val());

                $.ajax({
                    url: "{{ url('/admin/suplier-pembelian') }}",
                    method: "POST",
                    data: {
                        suplier_id: $('#suplier_id').val()
                    },
                    success: function(data) {
                        console.log(data);
                        $('#nama_produk').empty();
                        if ($('#suplier_id').val() != "") {
                            $.each(data, function(id, name) {
                                $('#nama_produk').append(new Option(name, id));
                            });
                        } else {
                            $('#nama_produk').append(
                                '<option value="">-- Nama Produk --</option>');
                        }

                    }
                });
            });
            //selesai

        });
    </script>
@endpush
