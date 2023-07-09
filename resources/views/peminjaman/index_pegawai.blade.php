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
          {{-- <h4 class="modal-title">Silahkan Scan QrCode Barang</h4> --}}
          <p class="text-small">Jika Kamera tidak muncul silahkan Reload halaman dengan Menekan Tombol Dibawah</p>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col">
                <div id="reader" width="600px"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onClick="window.location.reload(true)" id="saveBtnBarangDetail" value="create" class="btn btn-info">Reload</button>
          </div>
      </div>
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

        let scanner = new Html5QrcodeScanner('reader', {
          fps: 10,
          qrbox:{
            width : 250,
            height : 250
          }
        });

        scanner.render(onScanSuccess, onScanFailure);

        function onScanSuccess(result)
        {
          $.ajax({
                type: 'ajax',
                method: 'GET',
                url: '{!! url()->current() !!}/informasi_barang/'+ result,
                data: result,
                success: function(response) {
                    // console.log(response);
                    window.location.href = "{!! url()->current() !!}/informasi_barang/"+ result;
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        }

        function onScanFailure(err)
        {
          console.log(err);
        }
        
        function locationreload() {
        location.reload();
        }
  })
</script>
@endpush