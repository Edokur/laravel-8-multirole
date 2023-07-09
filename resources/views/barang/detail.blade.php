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
        <a href="/barang"  data-original-title="kembali" class="btn btn-primary"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a><br>
        <a href="javascript:void(0)" id="createNewBarangDetail" data-original-title="edit" class="my-3 btn btn-success createNewBarangDetail">Tambah Barang</a>
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h4>Data Barang : {{ $nama_barang }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="Detailbarang_table">
                        <thead>
                        <tr>
                            <th class="text-center">
                            No
                            </th>
                            <th>Kode Barang</th>
                            <th>Brand Barang</th>
                            <th>Harga Barang</th>
                            <th>Stok Barang</th>
                            <th>Kondisi Barang</th>
                            <th>Aksi</th>
                            <th>QR Code</th>
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

{{-- modal tambah barang v2  --}}    
{{-- @foreach ($barang as $item) --}}
<div class="modal fade" id="addModalBarangDetailV2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="POST" id="BarangDetailForm" name="BarangDetailForm" class="form-horizontal BarangDetailForm">
                <input type="hidden" name="barang_id" id="barang_id" value="{{ $id_barang }}">
                <div class="form-group">
                <label for="Name">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Enter Nama" disabled value="{{ $nama_barang }}">
                </div>
                <div class="form-group">
                <label for="Name">Brand <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="brand_barang" id="brand_barang" placeholder="Enter Tanggal">
                </div>
                <div class="form-group">
                <label for="Name">Harga <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder="Enter Harga">
                </div>
                <div class="form-group">
                <label for="Name">Tanggal Pembelian <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" name="tanggal_pembelian" id="tanggal_pembelian" placeholder="Enter Tanggal Pembelian">
                </div>
                <div class="form-group">
                <label for="Name">Jumlah Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Enter Jumlah Barang">
                </div>
                <div class="form-group">
                <label for="Name">Kondisi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kondisi_barang" id="kondisi_barang" placeholder="Enter Kondisi Barang">
                </div>
                <div class="form-group">
                <label for="Name">Umur Ekonomis <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umurekonomis_barang" id="umurekonomis_barang" placeholder="Enter Umur Ekonomis">
                </div>
                <div class="form-group">
                <label for="Name">Spesifikasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="spesifikasi_barang" id="spesifikasi_barang" placeholder="Enter Spesifikasi">
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
{{-- @endforeach --}}

{{-- modal edit barang v2 --}}
{{-- @foreach ($barang as $item) --}}
<div class="modal fade" id="editModalBarangDetailV2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Edit Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="POST" id="editBarangDetailForm" name="editBarangDetailForm" class="form-horizontal">
                <input type="hidden" name="barang_id" id="Ebarang_id" value="">
                <input type="hidden" name="kode_barang" id="Ekode_barang" value="">
                <div class="form-group">
                <label for="Name">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_barang" id="Enama_barang" placeholder="Enter Nama" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Brand <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="brand_barang" id="Ebrand_barang" placeholder="Enter Tanggal"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Harga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="harga_barang" id="Eharga_barang" placeholder="Enter Harga"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Tanggal Pembelian <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" name="tanggal_pembelian" id="Etanggal_pembelian" placeholder="Enter Tanggal Pembelian"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Jumlah Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="jumlah_barang" id="Ejumlah_barang" placeholder="Enter Jumlah Barang"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Kondisi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kondisi_barang" id="Ekondisi_barang" placeholder="Enter Kondisi Barang"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Umur Ekonomis <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umurekonomis_barang" id="Eumurekonomis_barang" placeholder="Enter Umur Ekonomis"  value="">
                </div>
                <div class="form-group">
                <label for="Name">Spesifikasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="spesifikasi_barang" id="Espesifikasi_barang" placeholder="Enter Spesifikasi"  value="">
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" type="submit" id="saveeditBtnBarangDetail" value="edit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}

{{-- modal detail barang v2 --}}
<div class="modal fade" id="detailModalBarangDetailV2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Detail Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="POST" id="detailBarangDetailForm" name="detailBarangDetailForm" class="form-horizontal">
                <div class="form-group">
                <label for="Name">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_barang" id="Dnama_barang" placeholder="Enter Nama" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Brand <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="brand_barang" id="Dbrand_barang" placeholder="Enter Tanggal" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Harga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="harga_barang" id="Dharga_barang" placeholder="Enter Harga" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Tanggal Pembelian <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" name="tanggal_pembelian" id="Dtanggal_pembelian" placeholder="Enter Tanggal Pembelian" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Jumlah Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="jumlah_barang" id="Djumlah_barang" placeholder="Enter Jumlah Barang" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Kondisi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kondisi_barang" id="Dkondisi_barang" placeholder="Enter Kondisi Barang" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Umur Ekonomis <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umurekonomis_barang" id="Dumurekonomis_barang" placeholder="Enter Umur Ekonomis" disabled value="">
                </div>
                <div class="form-group">
                <label for="Name">Spesifikasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="spesifikasi_barang" id="Dspesifikasi_barang" placeholder="Enter Spesifikasi" disabled value="">
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@foreach ($barang as $item)
<div class="modal fade" id="QrcodeModalBarangDetailV2{{ $item->kode_barang }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="POST" id="QrcodeBarangDetailForm" name="QrcodeBarangDetailForm" class="form-horizontal">
                <div class="form-group text-center mt-3">    
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::errorCorrection('H')->format('png')->size(300)->generate($item->kode_barang)) !!} ">
                    {{-- <img src="storage/app/{{ $item->qr_code}}"> --}}
                    {{-- {{ (new \App\Helpers\Helpers)->Create_Qrcode($item->kode_barang) }} --}}
                </div>
                
                <input type="hidden" name="Qkode_barang" class="Qkode_barang" value="{{ $item->kode_barang }}">
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{ asset('/') }}assets/img/qrcode/{{ $item->qr_code }}" class="btn btn-primary" download>Download</a>
            {{-- <button type="submit" class="btn btn-primary saveBtnQrcode" id="saveBtnQrcode">Download</button> --}}
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var barangDetail_table = $('#Detailbarang_table').DataTable({
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
                { data: 'kondisi_barang', name: 'kondisi_barang'},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false },
                { data: 'qr_code', name: 'qr_code', orderable: false, searchable: false, render: function (data, type, row, meta) {
                    return '<a href="javascript:void(0)"  class="btn btn-info btn-sm dataQrcode" data-toggle="modal" data-kode_barang="'+row.kode_barang+'">QR Code</a>';
                }},
            ]
        });

        $("#createNewBarangDetail").click(function(){
            $('#BarangDetailForm').trigger("reset");
            $('#addModalBarangDetailV2').modal('show');
        });

        $('body').on('click', '.modaldetailBarang', function(){ 
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
                    $('#Dnama_barang').val(response[0].nama_barang);
                    $('#Dbrand_barang').val(response[0].brand_barang);
                    $('#Dharga_barang').val(response[0].harga_barang);
                    $('#Dtanggal_pembelian').val(response[0].tanggal_pembelian);
                    $('#Djumlah_barang').val(response[0].jumlah_barang);
                    $('#Dkondisi_barang').val(response[0].kondisi_barang);
                    $('#Dumurekonomis_barang').val(response[0].umurekonomis_barang);
                    $('#Dspesifikasi_barang').val(response[0].spesifikasi);
                    $('#detailModalBarangDetailV2').modal('show');
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        })

        $("#saveBtnBarangDetail").click(function(e){

            var barang_id = $("#barang_id").val();
            var nama_barang = $("#nama_barang").val();
            var brand_barang = $("#brand_barang").val();
            var harga_barang = $("#harga_barang").val();
            var tanggal_pembelian = $("#tanggal_pembelian").val();
            var jumlah_barang = $("#jumlah_barang").val();
            var kondisi_barang = $("#kondisi_barang").val();
            var umurekonomis_barang = $("#umurekonomis_barang").val();
            var spesifikasi_barang = $("#spesifikasi_barang").val();

            const isFilled = (barang_id != "" && nama_barang != "" && brand_barang != "" && harga_barang != "" && tanggal_pembelian != "" && jumlah_barang != "" && kondisi_barang != "" && umurekonomis_barang != "" && spesifikasi_barang != "");

            e.preventDefault();
            var data = {
                'barang_id': $("#barang_id").val(),
                'nama_barang': $("#nama_barang").val(),
                'brand_barang': $("#brand_barang").val(),
                'harga_barang': $("#harga_barang").val(),
                'tanggal_pembelian': $("#tanggal_pembelian").val(),
                'jumlah_barang': $("#jumlah_barang").val(),
                'kondisi_barang': $("#kondisi_barang").val(),
                'umurekonomis_barang': $("#umurekonomis_barang").val(),
                'spesifikasi': $("#spesifikasi_barang").val(),
            };

            if (isFilled) {
                $.ajax({
                    data: data,
                    url: "{!! url()->current() !!}/store",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        console.log(response)
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                barangDetail_table.draw();
                                location.reload();
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

        $("#saveeditBtnBarangDetail").click(function(e){

            var barang_id = $("#Ebarang_id").val();
            var kode_barang = $("#Ekode_barang").val();
            var nama_barang = $("#Enama_barang").val();
            var brand_barang = $("#Ebrand_barang").val();
            var harga_barang = $("#Eharga_barang").val();
            var tanggal_pembelian = $("#Etanggal_pembelian").val();
            var jumlah_barang = $("#Ejumlah_barang").val();
            var kondisi_barang = $("#Ekondisi_barang").val();
            var umurekonomis_barang = $("#Eumurekonomis_barang").val();
            var spesifikasi_barang = $("#Espesifikasi_barang").val();

            const isFilled = (barang_id != "" && nama_barang != "" && brand_barang != "" && harga_barang != "" && tanggal_pembelian != "" && jumlah_barang != "" && kondisi_barang != "" && umurekonomis_barang != "" && spesifikasi_barang != "");

            e.preventDefault();
            var data = {
                'barang_id': $("#Ebarang_id").val(),
                'kode_barang': $("#Ekode_barang").val(),
                'nama_barang': $("#Enama_barang").val(),
                'brand_barang': $("#Ebrand_barang").val(),
                'harga_barang': $("#Eharga_barang").val(),
                'tanggal_pembelian': $("#Etanggal_pembelian").val(),
                'jumlah_barang': $("#Ejumlah_barang").val(),
                'kondisi_barang': $("#Ekondisi_barang").val(),
                'umurekonomis_barang': $("#Eumurekonomis_barang").val(),
                'spesifikasi': $("#Espesifikasi_barang").val(),
            };

            if (isFilled) {
                $.ajax({
                    data: data,
                    url: "{!! url()->current() !!}/update",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        console.log(response)
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                barangDetail_table.draw();
                                location.reload();
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

        
            $('body').on('click', '.deletedetailBarang', function(){
            var kode_barang = {
                'kode_barang': $(this).data("kode_barang")
            };

            Swal.fire({
                icon: 'warning',
                title: 'Mohon Perhatian !',
                text: 'Data yang dihapus tidak bisa dipulihkan kembali, apakah anda yakin ?',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus !',
                confirmButtonColor: '#007AFF',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#d33',
                reverseButtons: true,
            }).then(function(isvalid) {
                if (isvalid.value) {
                    $.ajax({
                        type: 'ajax',
                        method: 'POST',
                        data: kode_barang,
                        url: '{!! url()->current() !!}/delete_detailBarang',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                    barangDetail_table.draw();
                                })

                            } else {
                                Swal.fire('Proses Gagal!', response.message, 'error');
                            }
                        },
                        error: function(xmlresponse) {
                            console.log(xmlresponse);
                        }
                    })
                }
            })
        })

        $('body').on('click', '.dataQrcode', function(){
            var data = {
                'kode_barang': $(this).data("kode_barang"),
            };
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '{!! url()->current() !!}/datadetail',
                data: data,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // console.log(response[0].kode_barang);
                    // $('#Ebarang_id').val(response[0].barang_id);
                    $('.Qkode_barang').val(response[0].kode_barang);
                    // $('#QrcodeBarangDetailForm').trigger("reset");
                    $('#QrcodeModalBarangDetailV2'+response[0].kode_barang+'').modal('show');
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        })

        $('body').on('click', '.editdetailBarang', function(){ 
            var data = {
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
                    // console.log(response[0].kode_barang);
                    $('#Ebarang_id').val(response[0].barang_id);
                    $('#Ekode_barang').val(response[0].kode_barang);
                    $('#Enama_barang').val(response[0].nama_barang);
                    $('#Ebrand_barang').val(response[0].brand_barang);
                    $('#Eharga_barang').val(response[0].harga_barang);
                    $('#Etanggal_pembelian').val(response[0].tanggal_pembelian);
                    $('#Ejumlah_barang').val(response[0].jumlah_barang);
                    $('#Ekondisi_barang').val(response[0].kondisi_barang);
                    $('#Eumurekonomis_barang').val(response[0].umurekonomis_barang);
                    $('#Espesifikasi_barang').val(response[0].spesifikasi);
                    $('#editModalBarangDetailV2').modal('show');
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        });

        

    })

    
</script>
@endpush
