<!DOCTYPE html>
<html>
<head>
	<title>Recapitulation Salary Total</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        hr.dash-line {
            border-top: 2px dashed black;
        }
    </style>
</head>
<body>
	<style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
        th {
            border-top:1pt solid black;
            border-bottom:1pt solid black;
        }

        tr td {
            border-bottom:0.75pt solid black;
        }
    </style>

    <center>
        <h5><b>Laporan Peminjaman & Pengembalian Buku</b></h5>
        <h4>Laboratorium Manajamen UMM</h4>
        <h6>Per Tanggal {{ $date_from }} - {{ $date_until }}</h6>
        <br>
    </center>
	<table class='table'>
		<thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">No. Transaksi</th>
                <th class="text-center">NIM Peminjam</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Tanggal Pinjam</th>
                <th class="text-center">Batas Kembali</th>
                <th class="text-center">Tanggal Kembali</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $no=>$data)
            <tr>
                <td style="text-align:center">{{ $no+1 }}</td>
                <td style="text-align:center">{{ $data->id }}</td>
                <td style="text-align:center">{{ $data->mahasiswaInformation['nim'] }}</td>
                <td style="text-align:center">{{ $data->mahasiswaInformation['nama'] }}</td>
                <td style="text-align:center">{{ $data->bukuInformation['nama_buku'] }}</td>
                <td style="text-align:center">{{ $data->date_from }}</td>
                <td style="text-align:center">{{ $data->date_until }}</td>
                <td style="text-align:center">{{ $data->date_returned }}</td>
                {!! Azk::getStatusTransaksi ($data->status) !!}
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
