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
                         <th>Nama Pembeli</th>
                         <th>Nomor HP</th>
                         <th>Nomor Resi</th>
                         <th>Nama Produk</th>
                         <th>Jumlah Produk</th>
                         <th>Tanggal Pemesanan</th>
                         <th>Harga Produk</th>
                         <th>Pembelian Via</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
				<tr>
					     <td>{{ $i++ }}</td>
					     <td>{{ ucwords($value->nama_pelanggan) }}</td>
                         <td>{{ $value->no_hp }}</td>
                         <td>{{ $value->no_resi }}</td>
                         <td>{{ ucwords($value->nama_produk) }}</td>
                         <td>{{ $value->jumlah }}</td>
                         <td>{{ date('d-m-Y', strtotime($value->tgl_pesanan)) }}</td>
                         <td>{{ $value->harga }}</td>
                         <td>{{ $value->penjualan_via }}</td>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>