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
    <a href="/barang_pimpinan/halpdf" id="ExportPDF" data-original-title="pdf" class="mb-3 btn btn-primary">Export PDF</a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jenis Barang</h4>
                  </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="pimpinan-barang-table">
                    <thead>
                        <tr>
                            <th class="text-center">
                              No
                            </th>
                            <th>Nama Barang</th>
                            <th>Tanggal Registrasi</th>
                            <th>Pendistribusian</th>
                            <th>Jumlah Brand</th>
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

        var barang_table = $('#pimpinan-barang-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'barang_pimpinan',
        columns: [
            { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'nama_barang', name: 'nama_barang'},
            { data: 'tanggal_registrasi', name: 'tanggal_registrasi'},
            { data: 'pendistribusian', name: 'pendistribusian', orderable: false, searchable: false},
            { data: 'jumlah', name: 'jumlah', className: 'text-center', searchable: false},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    });
</script>
@endpush