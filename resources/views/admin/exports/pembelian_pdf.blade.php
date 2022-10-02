<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pemesanan Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style type="text/css">
        table {
            font-size: 12px;
            border-width: 1px;
            border-style: solid;
            border-color: black;
            border-collapse: collapse;
        }

        table .th {
            border-width: 1px;
            border-style: solid;
            border-color: black;
        }

        table .td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: black;
        }

        p,
        span,
        b {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="header text-center">
            <h4>Toko Serba - 99</h4>
            <span>Toko Perlengkapan Bayi Dan Ibu</span>
            <br>
            <span>Bekasi - Jawa Barat</span>
            <br>
            <small>shopee: https://shopee.co.id/tokoserba_99</small>
        </div>
        <hr style="border-width: 1px; border-style: solid; border-color: #000000;">
        <br>
        <span>Kepada Yth,</span>
        <br>
        <b>{{ $nama_pemasok->nama_suplier }}</b>
        <p>Di Tempat</p>
        <br>
        <p>Dengan hormat,</p>
        <p>Sehubungan dengan kebutuhan untuk memenuhi stok produk yang sudah kosong pada Toko kami,
            Kami ingin mengajukan permohonan kepada PT/Toko : <b>{{ $nama_pemasok->nama_suplier }}</b> untuk bisa dapat
            memenuhi kebutuhan stok produk kami, antara
            lain sebagai berikut :
        </p>
        <br>
        <table class="table text-center" border="1">
            <thead>
                <tr>
                    <th class="th">No</th>
                    <th class="th">Nama Produk</th>
                    <th class="th">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                <?php for($i=0; $i < $count_produk; $i++) {?>
                <tr>
                    <td class="td"><?php echo $no++; ?></td>
                    <td class="td"><?php echo $nama_produk[$i]; ?></td>
                    <td class="td"><?php echo $jumlah[$i]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <p> Produk - produk yang kami pesan diatas besar harapan kami untuk dikirim sesegera mungkin.
            Mengenai total harga yang harus dibayarkan mohon untuk segera dikonfirmasikan kembali kepada kami
            untuk dilakukan pembayaran.
        </p>
        <p>
            Atas perhatian serta kerja samanya kami ucapkan Terima Kasih.
        </p>
        <br>
        <span>Hormat Kami,</span>
        <br>
        <br>
        <b>Toko Serba - 99</b>
    </div>
</body>

</html>
