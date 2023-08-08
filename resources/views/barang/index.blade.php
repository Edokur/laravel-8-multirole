@extends('layouts.main')
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
  <a href="javascript:void(0)" id="createNewBarang" data-original-title="edit" class="mb-3 btn btn-success">Tambah Barang</a>
  <a href="/barang/halpdf" id="ExportPDF" data-original-title="pdf" class="mb-3 btn btn-primary">Export PDF</a>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Jenis Barang</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="barang-table">
                  <thead>
                    <tr>
                      <th class="text-center">
                        No
                      </th>
                      <th>Nama Barang</th>
                      <th>Tanggal Registrasi</th>
                      <th>Pendistribusian</th>
                      <th>Jumlah Brand</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
    
{{-- modal tambah barang v1  --}}
<div class="modal fade" id="addModalBarangV1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="BarangForm" name="BarangForm" class="form-horizontal">
          <div class="form-group">
            <label for="Name">Nama Barang <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_barang" id="namaBarang" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="Name">Tanggal Registrasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control datepicker" name="tanggal_registrasi" id="registrasiBarang" placeholder="Enter Tanggal">
          </div>
          <div class="form-group">
            <label for="Name">Pendistribusian <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pendistribusian" id="pendistribusianBarang" placeholder="Enter Pendistribusi">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" type="submit" id="saveBtnBarang" value="create" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="{{ asset('/') }}assets/js/barang.js"></script>
@endpush