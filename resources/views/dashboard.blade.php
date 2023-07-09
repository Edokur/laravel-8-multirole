@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>{{ $title }}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">{{ $title }}</a></div>
        {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
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
              <h4>Total Admin</h4>
            </div>
            <div class="card-body">
              10
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
              <h4>News</h4>
            </div>
            <div class="card-body">
              42
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
              <h4>Reports</h4>
            </div>
            <div class="card-body">
              1,201
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
              <h4>Online Users</h4>
            </div>
            <div class="card-body">
              47
            </div>
          </div>
        </div>
      </div>
    </div>
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
              10
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
              <h4>Data Peminjaman</h4>
            </div>
            <div class="card-body">
              42
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
    
@endsection