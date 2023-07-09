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
        <div class="card">
            <div class="card-header">
                
                <h4>Informasi Barang</h4>
            </div>
            <div class="card-body">
                @foreach ($barang as $item)
                    <div class="row">
                        <div class="col-6 mx-auto d-block">
                            <img src="https://via.placeholder.com/500" width="100%" height="80%" class="rounded align-items-center justify-content-center">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $item->kode_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputtext3" placeholder="text" value="{{ $item->nama_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Brand Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputtext3" placeholder="text" value="{{ $item->brand_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Harga Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputtext3" placeholder="text" value="{{ $item->harga_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Kondisi Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputtext3" placeholder="text" value="{{ $item->kondisi_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Spesifikasi Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="summernote" placeholder="text" value="{{ $item->spesifikasi }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Jumlah Barang Tersedia</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputtext3" placeholder="text" value="{{ $item->jumlah_barang }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext3" class="col-sm-3 col-form-label">Jumlah Yang ingin dipinjam :</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inputtext3" placeholder="text">
                                </div>
                            </div>

                            <a href="javascript:void(0)" id="createNewPeminjaman" data-original-title="edit" class="mb-3 btn btn-success float-right">Masukkan Keranjang</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
    
@endsection

@push('script')
<script>
</script>
@endpush