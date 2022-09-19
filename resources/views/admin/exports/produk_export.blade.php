<!DOCTYPE html>
<html>
<head>
	<title>TOKO SERBA 99 - Data Penjualan</title>
</head>
<body>

	<div class="container">
		<table border="2">
			<thead style="background:#d1d1d1;">
				<tr>
                         <th>No</th>
                         <th>Nama Produk</th>
                         <th>Stock</th>
                         <th>Jumlah Yang Keluar</th>
                         <th>Harga Beli</th>
                         <th>Harga Jual</th>
                         <th>Tanggal Barang Masuk</th>
                         <th>Tanggal Dibuat</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ucwords($value->nama_produk)}}</td>
                         <td>{{$value->total}}</td>
                         <td>{{$value->jml_keluar}}</td>
                         <td>{{$value->harga_beli}}</td>
                         <td>{{$value->harga_jual}}</td>
                         <td>{{date('d-m-Y', strtotime($value->tgl_produk_masuk))}}</td>
                         <td>{{date('d-m-Y H:i:s', strtotime($value->created_at))}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>