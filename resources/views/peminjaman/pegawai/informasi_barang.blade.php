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
        <a href="/peminjaman_pegawai"  data-original-title="kembali" class="btn btn-primary mb-3"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a><br>
        @if(count($barang) != 0)
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Barang</h4>
                </div>
                <div class="card-body">
                    @foreach ($barang as $item)
                    {{-- <?= dd($item); ?> --}}
                    <form  method="POST" id="InformasiForm" name="InformasiForm" >
                        <div class="row">
                            <div class="col-6 mx-auto d-block">
                                <img src="{{ asset('/') }}assets/img_barang/{{ $item->img_barang }}" width="100%" height="80%" class="rounded align-items-center justify-content-center">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $item->kode_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $item->nama_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Brand Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="brand_barang" value="{{ $item->brand_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Harga Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $item->harga_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Kondisi Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kondisi_barang" name="kondisi_barang" value="{{ $item->kondisi_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Spesifikasi Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="spesifikasi_barang" name="spesifikasi_barang" value="{{ $item->spesifikasi }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Jumlah Barang Tersedia</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $item->stok_barang }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext3" class="col-sm-3 col-form-label">Jumlah Yang ingin dipinjam :</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="jumlah_pinjaman" id="jumlah_pinjaman">
                                    </div>
                                </div>
                                <input type="hidden" name="barang_id" value="{{ $item->id }}" id="barang_id">
                            </div>
                        </div>
                    </form>
                    <button id="saveKeranjang" type="submit" data-original-title="edit" class="mb-3 btn btn-success float-right">Masukkan Keranjang</button>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-info" role="alert" style="width: 100%">
                        <h2 class="alert-heading">Informasi Barang!!</h2>
                        <p>Mohon Maaf QR Code yang kamu Masukkan Tidak Terdaftar Dalam PT Baracipta Esa Engineering</p>
                        <hr>
                        <p class="mb-0">Silahkan Kembali Dan Hubungi Administrasi PT Baracipta Esa Engineering Untuk Informasi Lebih Lanjut</p>
                    </div>
                </div>
            </div>
        @endif
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

        $("#saveKeranjang").click(function(e){
            var barang_id = $("#barang_id").val();
            var jumlah_pinjaman = $("#jumlah_pinjaman").val();
            var kode_barang = $("#kode_barang").val();
            var nama_barang = $("#nama_barang").val();
            var kondisi_barang = $("#kondisi_barang").val();
            var spesifikasi_barang = $("#spesifikasi_barang").val();

            const isFilled = (jumlah_pinjaman != "");

            e.preventDefault();
            var data = {
                'barang_id': $("#barang_id").val(),
                'jumlah_pinjaman': $("#jumlah_pinjaman").val(),
                'kode_barang': $("#kode_barang").val(),
                'nama_barang': $("#nama_barang").val(),
                'kondisi_barang': $("#kondisi_barang").val(),
                'spesifikasi_barang': $("#spesifikasi_barang").val(),
            };

            if (isFilled) {
                $.ajax({
                    data: data,
                    url: "{!! url()->current() !!}/store",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                window.location.href = "{{ route('keranjang')}}";
                            })
                        } else {
                            Swal.fire('Proses Gagal!', response.message, 'error');
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

    });
</script>
@endpush