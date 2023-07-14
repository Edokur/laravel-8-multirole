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
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <form action="POST" id="perhitunganForm">
                    @csrf
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
                                <select class="form-control" name="kode_barang" id="kode_barang">
                                    @foreach ($barang as $item)
                                    <option value="{{ $item->kode_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <input type="hidden" name="nama_barang" id="nama_barang">
                            <input type="hidden" name="brand_barang" id="brand_barang">
                            <div class="form-group col-md-6 col-12">
                                <label>Harga Perolehan</label>
                                <input type="text" class="form-control" readonly id="harga_perolehan" name="harga_perolehan">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tarif Penyusutan (%) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="tarif_penyusutan" name="tarif_penyusutan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-6 col-12">
                                <label>Umur Ekonomis (thn)</label>
                                <input type="text" class="form-control" readonly id="umurekonomis_barang" name="umurekonomis_barang">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Hasil Penyusutan (Perbulan)</label>
                                <input type="text" class="form-control" readonly id="hasil_perhitungan" name="hasil_perhitungan">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-secondary" style="color: black">Reset</button>
                </form> 
                    <button type="submit" class="btn btn-success" id="savePerhitungan">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <a href="/perhitungan/halpdf" id="createNewPengguna" data-original-title="pdf" class=" btn btn-primary mb-3">Export PDF</a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Tabel Hasil Perhitungan</h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="perhitungan-table">
                    <thead>
                        <tr>
                        <th class="text-center">
                            No
                        </th>
                        <th>Nama Barang</th>
                        <th>Brand Barang</th>
                        <th>Tanggal Perhitungan</th>
                        <th>Nilai Penyusutan</th>
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
    
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var perhitungan_table = $('#perhitungan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! url()->current() !!}",
            columns: [
                { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama_barang', name: 'nama_barang' },
                { data: 'brand_barang', name: 'brand_barang' },
                { data: 'tanggal_perhitungan', name: 'tanggal_perhitungan'},
                { data: 'hasil_perhitungan', name: 'hasil_perhitungan'},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false },
            ]
        });
    
        $('body').on('change', '#kode_barang', function(){ 
            var data = {
                'kode_barang': $("#kode_barang").val(),
            };
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '/perhitungan/data_barang',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#nama_barang').val(response[0].nama_barang);
                    $('#brand_barang').val(response[0].brand_barang);
                    $('#harga_perolehan').val(response[0].harga_barang);
                    $('#umurekonomis_barang').val(response[0].umurekonomis_barang);
                    $('#tarif_penyusutan').val(null);
                    $('#hasil_perhitungan').val(null);
                },
                error: function(xmlresponse) {
                    console.log(xmlresponse);
                }
            });
        });

        $('body').on('change', '#tarif_penyusutan', function(){
            var tarif_penyusutan = $("#tarif_penyusutan").val();
            var harga_perolehan = $("#harga_perolehan").val();
                    
            var round = Math.round;
            let percentage = round(tarif_penyusutan) / 100 ;
            var hasil = round(harga_perolehan) * percentage;
            $('#hasil_perhitungan').val(hasil);
        });

        $("#savePerhitungan").click(function(e){

            var kode_barang = $("#kode_barang").val();
            var nama_barang = $("#nama_barang").val();
            var brand_barang = $("#brand_barang").val();
            var harga_perolehan = $("#harga_perolehan").val();
            var tarif_penyusutan = $("#tarif_penyusutan").val();
            var umurekonomis_barang = $("#umurekonomis_barang").val();
            var hasil_perhitungan = $("#hasil_perhitungan").val();

            const isFilled = (harga_perolehan != "" && tarif_penyusutan != "" && umurekonomis_barang != "" && hasil_perhitungan != "");

            e.preventDefault();
            var data = {
                'kode_barang': $("#kode_barang").val(),
                'nama_barang': $("#nama_barang").val(),
                'brand_barang': $("#brand_barang").val(),
                'harga_perolehan': $("#harga_perolehan").val(),
                'tarif_penyusutan': $("#tarif_penyusutan").val(),
                'umurekonomis_barang': $("#umurekonomis_barang").val(),
                'hasil_perhitungan': $("#hasil_perhitungan").val(),
            };

            if (isFilled) {
                $.ajax({
                    data: data,
                    url: "/perhitungan/store",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        console.log(response)
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                perhitungan_table.draw();
                                $("#perhitunganForm").trigger("reset");
                                // location.reload();
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
                });
            }
        });

        $('body').on('click', '.deletePerhitungan', function(){
        var perhitungan_id = $(this).data("id");
        console.log(perhitungan_id);

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
                    data: perhitungan_id,
                    url: 'perhitungan/destroy/'+perhitungan_id,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                perhitungan_table.draw();
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
    });
    });
</script>
@endpush