<!DOCTYPE html>
<html>
<head>
	<title>TOKO SERBA 99 - Data Produk</title>
</head>
<body>

	<div class="container">
		<table border="2">
			<thead style="background:#d1d1d1;">
				<tr>
                         <th>No</th>
                         <th>Nama Customer</th>
                         <th>Nomor HP</th>
                         <th>Nomor Resi</th>
                         <th>Nama Produk</th>
                         <th>Produk Dibeli</th>
                         <th>Tanggal Pemesanan</th>
                         <th>Harga Produk</th>
                         <th>Total Harga</th>
                         <th>Total Produk Dibeli</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
				<tr>
					     <td>{{ $i++ }}</td>
					     <td>{{ucwords($value->nama_pelanggan)}}</td>
                         <td>{{$value->no_hp}}</td>
                         <td>{{$value->no_resi}}</td>
                         <td>{{ucwords($value->nama_produk)}}</td>
                         <td>{{$value->jumlah_produk}}</td>
                         <td>{{date('d-m-Y', strtotime($value->tgl_pesenan))}}</td>
                         <td>{{$value->harga_produk}}</td>
                         <td>{{$value->total_harga}}</td>
                         <td>{{$value->total_jml_brg}}</td>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>