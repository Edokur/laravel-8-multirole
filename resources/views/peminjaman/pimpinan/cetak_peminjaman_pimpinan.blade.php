<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
    <div class="form-group">
        <p class="text-center"><b>Laporan Data Peminjaman PT Baracipta Esa Engineering</b></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th class="text-center">
                    No
                  </th>
                  <th>Nama Peminjam</th>
                  <th>Kode Pinjam</th>
                  <th>Tanggal Peminjaman</th>
                  <th>Tanggal Pengembalian</th>
                  <th>Keterangan</th>
                  {{-- <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Peminjaman</th> --}}
                  {{-- <th>Kondisi</th> --}}
                  {{-- <th>Spesifikasi</th> --}}
                </tr>
              </thead>
              <tbody>
                @for ($i = 0; $i < count($peminjaman); $i++)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                      <td>{{ $peminjaman[$i]->name}}</td>
                      <td>{{ $peminjaman[$i]->kode_pinjam}}</td>
                      <td>{{ $peminjaman[$i]->tgl_pinjam}}</td>
                      <td>{{ $peminjaman[$i]->tgl_kembali}}</td>
                      <td>{{ $peminjaman[$i]->keterangan_peminjaman}}</td>
                      {{-- <td>{{ $barang[$i][0]->kode_barang}}</td>
                      <td>{{ $barang[$i][0]->nama_barang }}</td>
                      <td>{{ $pinjaman[$i][0] }}</td> --}}
                      {{-- <td>{{ $barang[$i][0]->kondisi_barang }}</td> --}}
                      {{-- <td>{{ $barang[$i][0]->spesifikasi }}</td> --}}
                    </tr>
                @endfor
                </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>