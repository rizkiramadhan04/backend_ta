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
                            <input class="form-control" placeholder="Nama Produk" type="text" name="nama_produk[]"
                                value="{{ $nama_produk[$i] }}" id="nama_produk{{ $no++ }}" />
                            @error('nama_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <input class="form-control" placeholder="Jumlah" type="number" name="jumlah[]"
                                value="{{ $jumlah[$i] }}" id="jumlah{{ $no++ }}" />
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-check mr-sm-2 mt-4">
                            <input class="form-check-input" type="checkbox" id="check{{ $no++ }}">
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

            for (var i = 1; i < 10; i++) {
                console.log("Hallo ", i);
            }

            $("#check6").click(function() {
                if ($("#check6").is(":checked")) {
                    $("#nama_produk4").attr("disabled", true);
                    $("#jumlah5").attr("disabled", true);
                } else {
                    $("#nama_produk4").attr("disabled", false);
                    $("#jumlah5").attr("disabled", false);
                }
            });


        });
    </script>
@endpush
