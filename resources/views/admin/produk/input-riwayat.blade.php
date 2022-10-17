@extends('layout.admin')
@section('title', 'Input Produk Masuk')
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
                    <div class="col-md-6">
                        <input class="form-control" placeholder="" type="text" name="nama_pemasok"
                            value="{{ $nama_pemasok }}" />
                        @error('created_at')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <h5 class="mt-5">Produk</h5>

                    <?php $no = 1; for($i=0; $i < $count_data; $i++) { ?>


                    <div class="row">
                        {{-- <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                              </div>
                            </div> --}}
                        {{-- <input type="text" class="form-control" aria-label="Text input with checkbox" value="{{ $nama_produk[$i] }}"> --}}
                        <div class="col-md-6 mt-3">
                            <input class="form-control nama_produk" placeholder="Nama Produk" type="text"
                                name="nama_produk[]" value="{{ $nama_produk[$i] }}" id="nama_produk{{ $i }}" />
                            @error('nama_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <input class="form-control jumlah" placeholder="Jumlah" type="number" name="jumlah[]"
                                value="{{ $jumlah[$i] }}" id="jumlah{{ $i }}" />
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-check mr-sm-2 mt-4">
                            <input class="form-check-input" type="checkbox" id="check{{ $i }}">
                            <label class="form-check-label" for="inlineFormCheck">
                                Sesuai
                            </label>
                        </div>

                        {{-- <div class="col-md-2">
                            <a class="btn btn-success" href="javascript:void(0);" id="add_button"
                                title="Add field">Tambah</a>
                        </div> --}}
                    </div>

                    <?php } ?>

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

            var jml_field = $('.nama_produk').length;
            // console.log(jml_field);

            for (var i = 0; i < jml_field; i++) {
                $("#check" + [i]).click(function() {
                    console.log("#check" + [i]);
                    if ($("#check" + [i]).is(":checked")) {
                        console.log("#check" + i, "#nama_produk" + i, "#jumlah" + i);
                        // $("#nama_produk" + i).attr("disabled", true);
                        // $("#jumlah" + i).attr("disabled", true);
                    } else {
                        console.log("Gagal");
                        // $("#nama_produk" + i).attr("disabled", false);
                        // $("#jumlah" + i).attr("disabled", false);
                    }
                });
            }

        });
    </script>
@endpush
