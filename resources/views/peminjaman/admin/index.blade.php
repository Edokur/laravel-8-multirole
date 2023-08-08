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
    <a href="/peminjaman/halpdf" id="ExportPDF" data-original-title="pdf" class="mb-3 btn btn-primary">Export PDF</a>
      <div class="card">
        <div class="card-header">
          <h4>Data Peminjaman</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item mr-1" role="presentation">
              <button class="nav-link active" id="pengajuan-tab" data-toggle="tab" data-target="#pengajuan" type="button" role="tab" aria-controls="pengajuan" aria-selected="false">Pengajuan</button>
            </li>
            <li class="nav-item mr-1" role="presentation">
              <button class="nav-link" id="terpinjam-tab" data-toggle="tab" data-target="#terpinjam" type="button" role="tab" aria-controls="terpinjam" aria-selected="true">Terpinjam</button>
            </li>
            <li class="nav-item mr-1" role="presentation">
              <button class="nav-link" id="dibatalkan-tab" data-toggle="tab" data-target="#dibatalkan" type="button" role="tab" aria-controls="dibatalkan" aria-selected="true">Ditolak</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="false">Selesai</button>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pengajuan" role="tabpanel" aria-labelledby="pengajuan-tab">
              @include('peminjaman.admin.pengajuan_table')
            </div>
            <div class="tab-pane fade show " id="terpinjam" role="tabpanel" aria-labelledby="terpinjam-tab">
              @include('peminjaman.admin.terpinjam_table')
            </div>
            <div class="tab-pane fade show " id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
              @include('peminjaman.admin.dibatalkan_table')
            </div>
            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
              @include('peminjaman.admin.selesai_table')
            </div>
          </div>
        </div>
      </div>

  </div>
</section>
    
@endsection

@push('script')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

  });
</script>
@endpush