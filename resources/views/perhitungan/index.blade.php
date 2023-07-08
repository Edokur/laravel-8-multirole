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
  <a href="/perhitungan/halpdf" id="createNewPengguna" data-original-title="pdf" class=" btn btn-primary">Export PDF</a>
  <div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <form action="#" method="post">
                <div class="card-header">
                    <h4 class="text-dark">Masukkan Perhitungan Anda</h4>
                </div>
                <div class="card-body">
                  <div class="alert alert-info">
                      <p class="mb-1 col-md-6 col-12">Mohon Pastikan Data Benar!!</p>
                  </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-12 col-12">
                            <label for="Name">Nama Barang<span class="text-danger">*</span></label>
                            <select class="form-control" name="role" id="jkPengguna">
                              <option value="">-- pilih --</option>
                              <option value="Pria">Pria</option>
                              <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-6 col-12">
                            <label>Harga Perolehan</label>
                            <input type="text" class="form-control" value="Rp. 300.000.00" required="" disabled>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Tarif Penyusutan (%)</label>
                            <input type="text" class="form-control" value="25%" required="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-6 col-12">
                            <label>Umur Ekonomis</label>
                            <input type="text" class="form-control" value="4 Tahun" required="" disabled>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Hasil</label>
                            <input type="text" class="form-control" value="Rp. 35.000" required="" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-secondary" style="color: black">Reset</button>
                    <button class="btn btn-success">Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>
  </div>
</section>
    
@endsection