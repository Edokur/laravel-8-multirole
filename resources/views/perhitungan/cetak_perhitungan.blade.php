<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Perhitungan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
    <div class="form-group">
        <p class="text-center"><b>Laporan Data Perhitungan PT Baracipta Esa Engineering</b></p>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Brand Barang</th>
                <th>Harga Perolehan</th>
                <th>Umur Ekonomis Barang</th>
                <th>Tarif Penyusutan</th>
                <th>Tanggal Perhitungan</th>
                <th>Hasil Penyusutan (Perbulan)</th>
                <th>Harga Saat Ini</th>
            </tr>
            @foreach ($cetak as $item)
            <tr>
                <td >{{ $loop->iteration }}</td>
                <td >{{ $item->nama_barang }}</td>
                <td >{{ $item->brand_barang }}</td>
                <td >Rp.{{ $item->harga_perolehan }}</td>
                <td >{{ $item->umurekonomis_barang }} Tahun</td>
                <td >{{ $item->tarif_penyusutan }} %</td>
                <td >{{ $item->tanggal_perhitungan }}</td>
                <td >Rp. {{ $item->hasil_perhitungan }}</td>
                <td >Rp. {{ $item->harga_terbaru }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>