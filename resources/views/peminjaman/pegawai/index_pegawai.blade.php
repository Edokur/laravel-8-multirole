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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Peminjaman</h4>
          </div>
          <div class="card-body">
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
                  @include('peminjaman.pegawai.pengajuan_table_pegawai')
                </div>
                <div class="tab-pane fade show " id="terpinjam" role="tabpanel" aria-labelledby="terpinjam-tab">
                  @include('peminjaman.pegawai.terpinjam_table_pegawai')
                </div>
                <div class="tab-pane fade show " id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
                  @include('peminjaman.pegawai.dibatalkan_table_pegawai')
                </div>
                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                  @include('peminjaman.pegawai.selesai_table_pegawai')
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

  </div>
</section>

<div class="modal fade" id="addModalPeminjaman" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
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
                    window.location.href = "{!! url()->current() !!}/informasi_barang/"+ result;
                },
                error: function(xmlresponse) {
                  Swal.fire('Perhatian', 'QrCode tidak ditemukan, Silahkan Gunakan Qrcode lainnya', 'error');
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