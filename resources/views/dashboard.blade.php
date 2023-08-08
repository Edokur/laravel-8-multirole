@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>{{ $title }}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">{{ $title }}</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
      </div>
  </div>

  <div class="section-body">
    @if (auth()->user()->role=="Admin")
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pengguna</h4>
            </div>
            <div class="card-body">
              {{ $total_user }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jenis Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_jenisbarang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Aset Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_barang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Peminjaman</h4>
            </div>
            <div class="card-body">
              {{ $total_peminjaman }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <canvas id="barangChart" width="100%" height="24%"></canvas>
    @endif

    @if(auth()->user()->role=="Pegawai")
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Aset Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_barang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jenis Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_jenisbarang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Terpinjam</h4>
            </div>
            <div class="card-body">
              {{ $total_peminjamanpegawai }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md table-hover" id="keranjang-table">
                <thead>
                  <tr>
                    <th class="text-center">
                      No
                    </th>
                    <th>Kode Pinjam</th>
                    <th>Terlambat</th>
                    <th>Tgl Peminjaman</th>
                    <th>Tgl Pengembalian</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $item)
                    <tr>
                      <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $item->kode_pinjam }}</td>
                        <td>{{ $item->terlambat }} Hari</td>
                        <td>{{ $item->tgl_pinjam }}</td>
                        <td>{{ $item->tgl_kembali }}</td>
                        <td>{{ $item->status }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
    @endif


    @if(auth()->user()->role=="Pimpinan")
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pengguna</h4>
            </div>
            <div class="card-body">
              {{ $total_user }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jenis Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_jenisbarang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Aset Barang</h4>
            </div>
            <div class="card-body">
              {{ $total_barang }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Peminjaman</h4>
            </div>
            <div class="card-body">
              {{ $total_peminjaman }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <canvas id="PimpinanbarangChart" width="100%" height="24%"></canvas>
    @endif
  </div>
</section>
    
@endsection

@push('script')
<script>
  @if (auth()->user()->role=="Admin")
  var ctx = document.getElementById('barangChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {!! json_encode($data) !!},
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  @endif
  @if (auth()->user()->role=="Pimpinan")
  var ctx = document.getElementById('PimpinanbarangChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {!! json_encode($data) !!},
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  @endif
</script>
@endpush