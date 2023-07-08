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
  <a href="javascript:void(0)" id="createNewPeminjaman" data-original-title="edit" class="mb-3 btn btn-success">Tambah Peminjaman</a>

  {{-- {{ auth()->user()->name }} --}}
  {{-- <<?= dd(auth()->user()); ?> --}}
      <p>Halaman Keranjang Pinjam</p>
  </div>
</section>

<div class="modal fade" id="addModalPeminjaman" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
          <form action="POST" id="PeminjamanForm" name="PeminjamanForm" class="form-horizontal PeminjamanForm">
              <div class="form-group">
              <label for="Name">Nama Barang <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Enter Nama" disabled >
              </div>
          </form>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" type="submit" id="saveBtnBarangDetail" value="create" class="btn btn-primary">Save changes</button>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <div id="reader" width="600px"></div>
  </div>
  <div class="col-6">
    <input type="text" id="result">
  </div>
</div>
@endsection

@push('script')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
  $(document).ready(function(){
    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#createNewPeminjaman").click(function(){
            $('#PeminjamanForm').trigger("reset");
            $('#addModalPeminjaman').modal('show');
        });
    
        function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
          console.log(`Code matched = ${decodedText}`, decodedResult);
          $('#result').val(decodedText);
        }

        function onScanFailure(error) {
          // handle scan failure, usually better to ignore and keep scanning.
          // for example:
          console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
          "reader",
          { fps: 10, qrbox: {width: 250, height: 250} },
          /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  })
</script>
@endpush