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
        <a href="/barang_pimpinan"  data-original-title="kembali" class="btn btn-primary mb-3"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a><br>
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h4>Data Barang : {{ $nama_barang }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="Admin_Detailbarang_table">
                        <thead>
                        <tr>
                            <th class="text-center">
                            No
                            </th>
                            <th>Kode Barang</th>
                            <th>Brand Barang</th>
                            <th>Harga Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Stok Barang</th>
                            <th>Kondisi Barang</th>
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

{{-- modal detail barang v2 --}}
<div class="modal fade" id="PegawaidetailModalBarangDetailV2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Detail Barang</h4>
            </div>
            <div class="modal-body">
            <form action="POST" id="detailBarangDetailForm" name="detailBarangDetailForm" class="form-horizontal">
                <div class="form-group">
                <label for="Name">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_barang" id="PDnama_barang" placeholder="Enter Nama" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Brand <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="brand_barang" id="PDbrand_barang" placeholder="Enter Tanggal" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Harga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="harga_barang" id="PDharga_barang" placeholder="Enter Harga" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Tanggal Pembelian <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" name="tanggal_pembelian" id="PDtanggal_pembelian" placeholder="Enter Tanggal Pembelian" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Jumlah Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="jumlah_barang" id="PDjumlah_barang" placeholder="Enter Jumlah Barang" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Stok Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="stok_barang" id="PDstok_barang" placeholder="Enter Jumlah Barang" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Kondisi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kondisi_barang" id="PDkondisi_barang" placeholder="Enter Kondisi Barang" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Umur Ekonomis <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umurekonomis_barang" id="PDumurekonomis_barang" placeholder="Enter Umur Ekonomis" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Spesifikasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="spesifikasi_barang" id="PDspesifikasi_barang" placeholder="Enter Spesifikasi" disabled value="">
                </div>
                <div class="form-group" id="output_foto">
                    <label for="Name">Foto Barang <span class="text-danger">*</span></label>
                    <div class="input-group" id="PDimg_barang">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var barangDetail_table = $('#Admin_Detailbarang_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! url()->current() !!}",
            columns: [
                { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'kode_barang', name: 'kode_barang' },
                { data: 'brand_barang', name: 'brand_barang'},
                { data: 'harga_barang', name: 'harga_barang'},
                { data: 'jumlah_barang', name: 'jumlah_barang'},
                { data: 'stok_barang', name: 'stok_barang'},
                { data: 'kondisi_barang', name: 'kondisi_barang'},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false },
            ]
        });

        $('body').on('click', '.modaldetailBarangPegawai', function(){ 
            var data = {
                'barang_id': $("#barang_id_detail").val(),
                'kode_barang': $(this).data("kode_barang"),
            };
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '{!! url()->current() !!}/datadetail',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#PDnama_barang').val(response[0].nama_barang);
                    $('#PDbrand_barang').val(response[0].brand_barang);
                    $('#PDharga_barang').val(response[0].harga_barang);
                    $('#PDtanggal_pembelian').val(response[0].tanggal_pembelian);
                    $('#PDjumlah_barang').val(response[0].jumlah_barang);
                    $('#PDstok_barang').val(response[0].stok_barang);
                    $('#PDkondisi_barang').val(response[0].kondisi_barang);
                    $('#PDumurekonomis_barang').val(response[0].umurekonomis_barang);
                    $('#PDimg_barang').html('<img src="{!! url('assets/img_barang/') !!}/'+response[0].img_barang+'" width="80%" height="80%"/>');
                    $('#PDspesifikasi_barang').val(response[0].spesifikasi);
                    $('#PegawaidetailModalBarangDetailV2').modal('show');
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        })
    })

    
</script>
@endpush
