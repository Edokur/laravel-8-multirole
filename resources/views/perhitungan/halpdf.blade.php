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
    <a href="/perhitungan"  data-original-title="kembali" class="btn btn-primary"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a>
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Masukkan Tanggal Rekapan Data</h4>
                </div>
                <form action="/barang/cetakpdf" method="post">
                <div class="card-body">
                    <div class="alert alert-info">
                        <p class="mb-1 col-md-6 col-12">Mohon Pastikan Data Benar!!</p>
                    </div>
                        <div class="row mt-2">
                            <div class="form-group col-sm-6">
                                <label for="Name">Tanggal Awal<span class="text-danger">*</span></label>
                                <input type="text" id="tanggal_awal" class="form-control datepicker" data-toggle="datetimepicker" data-target="#datepicker" autocomplete="off" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-sm-6">
                                <label for="Name">Tanggal Akhir<span class="text-danger">*</span></label>
                                <input type="text" id="tanggal_akhir" class="form-control datepicker" data-toggle="datetimepicker" data-target="#datepicker" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-secondary" style="color: black">Reset</button>
                        <button type="submit" id="saveBtnCetakPerhitungan" class="btn btn-success">Submit</button>
                    </div>
                </form> 
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

        $("#saveBtnCetakPerhitungan").click(function(e){

            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            const isFilled = (tanggal_awal != "" && tanggal_akhir != "");

            e.preventDefault();
            var data = {
                'tanggal_awal': $("#tanggal_awal").val(),
                'tanggal_akhir': $("#tanggal_akhir").val(),
            };

            if (isFilled) {
                $.ajax({
                    data: data,
                    url: "{!! url()->current() !!}/cetakpdf",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        console.log(response)
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                // location.reload();
                            })
                        } else {
                            Swal.fire('Proses Gagal!', response.message, 'info');
                        }
                        
                    },
                    error: function(xmlresponse) {
                        console.log(xmlresponse);
                    }
                });
            } else {
                Swal.fire({
                    confirmButtonColor: '#3ab50d',
                    icon: 'error',
                    title: 'Peringatan',
                    text: 'Isian bertanda bintang wajib diisi',
                })
            }
            });
    })
</script>
@endpush