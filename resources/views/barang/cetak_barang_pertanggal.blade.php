{{-- @extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data</a></div>
        <div class="breadcrumb-item"><a href="#">{{ $title }}</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">

    </div>

</section>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
    <div class="form-group">
        <p class="text-center"><b>Laporan Data Barang PT Baracipta Esa Engineering</b></p>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Brand Barang</th>
                <th>Harga Barang</th>
                <th>Kondisi Barang</th>
                <th>Spesifikasi Barang</th>
            </tr>
            @foreach ($cetak as $item)
            <tr>
                <td class="mx-1">{{ $loop->iteration }}</td>
                <td class="mx-1">{{ $item->kode_barang }}</td>
                <td class="mx-1">{{ $item->nama_barang }}</td>
                <td class="mx-1">{{ $item->brand_barang }}</td>
                <td class="mx-1">{{ $item->harga_barang }}</td>
                <td class="mx-1">{{ $item->kondisi_barang }}</td>
                <td class="mx-1">{{ $item->spesifikasi }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>