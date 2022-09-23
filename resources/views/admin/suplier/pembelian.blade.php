@extends('layout.admin')
@section('title', 'Tambah User')
@section('content')

     <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Pembelian Produk</h1>
        </div>
        
         <form method="POST" action="">
                <div class="form-group col-xl-6 col-md-4">
                    <label for="nama_produk">Nama Suplier</label>
                    <select class="form-control @error('produk_id') is-invalid @enderror" id="nama_produk" name="produk_id">
                        <option value="">-- Pilih Suplier --</option>
                       
                    </select>
                    @error('produk_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
		        <div class="form-group" id="dynamic_form">
                    <p>Produk<p>
	                <div class="form-group baru-data row">
		                <div class="col-md-3">
		                    <input type="text" name="nama_produk" placeholder="Nama Produk" class="form-control">
		                </div>
		                <div class="col-md-2">
		                    <input type="number" name="jumlah_produk" placeholder="Jumlah Produk" class="form-control">
		                </div>
		                <div class="col-md-3">
		                	<select class="form-control">
		                		<option value="">- Pilih Kategori -</option>
		                		<option value="1">Buku</option>
		                		<option value="2">Elektronik</option>
		                		<option value="3">Kesehatan</option>
		                		<option value="4">Rumah Tangga</option>
		                		<option value="5">Mainan Hobi</option>
		                		<option value="6">Olahraga</option>
		                	</select>
		                </div>
		                {{-- <div class="col-md-3">
		                    <textarea name="deskripsi_produk" placeholder="Deskripsi Produk" class="form-control" rows="1"></textarea>
		                </div> --}}
		                <div class="button-group">
		                    <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>
		                    <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>
		                </div>
		            </div>
	            </div>
				<button type="submit" class="btn btn-primary btn-simpan"><i class="fa fa-save"></i> Submit</button>
	        </form>

    </div>
@endsection

@push('js')
    <script>

            function addForm(){
            var addrow = '<div class="form-group baru-data row">\
                        <div class="col-md-3">\
                            <input type="text" name="nama_produk" placeholder="Nama Produk" class="form-control">\
                        </div>\
                        <div class="col-md-2">\
                            <input type="number" name="jumlah_produk" placeholder="Jumlah Produk" class="form-control">\
                        </div>\
                        <div class="col-md-3">\
                        <select class="form-control">\
                            <option value="">- Pilih Kategori -</option>\
                            <option value="1">Buku</option>\
                            <option value="2">Elektronik</option>\
                            <option value="3">Kesehatan</option>\
                            <option value="4">Rumah Tangga</option>\
                            <option value="5">Mainan Hobi</option>\
                            <option value="6">Olahraga</option>\
                        </select>\
                        </div>\
                        <div class="col-md-3">\
                            <textarea name="deskripsi_produk" placeholder="Deskripsi Produk" class="form-control" rows="1"></textarea>\
                        </div>\
                        <div class="button-group">\
                            <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                            <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
                        </div>\
                </div>'
            $("#dynamic_form").append(addrow);
            }

            $("#dynamic_form").on("click", ".btn-tambah", function(){
            addForm()
            $(this).css("display","none")     
            var valtes = $(this).parent().find(".btn-hapus").css("display","");
            })

            $("#dynamic_form").on("click", ".btn-hapus", function(){
            $(this).parent().parent('.baru-data').remove();
            var bykrow = $(".baru-data").length;
            if(bykrow==1){
            $(".btn-hapus").css("display","none")
            $(".btn-tambah").css("display","");
            }else{
            $('.baru-data').last().find('.btn-tambah').css("display","");
            }
            });

            $('.btn-simpan').on('click', function () {
            $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
                if( $(this).val() == "" ) {
                    event.preventDefault()
                    $(this).css('border-color', 'red');
                    
                    $(this).on('focus', function() {
                        $(this).css('border-color', '#ccc');
                    });
                }
            })
            });

    </script>
@endpush
