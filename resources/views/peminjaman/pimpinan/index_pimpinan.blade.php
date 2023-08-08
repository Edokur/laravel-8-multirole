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
    <a href="/peminjaman_pimpinan/halpdf" id="createNewPengguna" data-original-title="pdf" class=" btn btn-primary mb-3">Export PDF</a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Data Peminjaman</h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="pimpinan-peminjaman-table">
                    <thead>
                        <tr>
                        <th class="text-center">
                        No
                        </th>
                        <th>Kode Peminjaman</th>
                        <th>Peminjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        {{-- <th>Status</th> --}}
                        <th>Keterangan</th>
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

        var peminjaman_table = $('#pimpinan-peminjaman-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'peminjaman_pimpinan',
        columns: [
            { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'kode_pinjam', name: 'kode_pinjam' },
            { data: 'name', name: 'name'},
            { data: 'tgl_pinjam', name: 'tgl_pinjam' },
            { data: 'tgl_kembali', name: 'tgl_kembali' },
            // { data: 'keterangan_proses', name: 'keterangan_proses', render:function (data, type, full, meta) {
            //             if (full.keterangan_proses == 'Peminjaman') {
            //                 var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' +full.id +'" data-original-title="change"  id="changestatus" class="mr-1 change btn btn-success btn-sm">Peminjaman</a>';
            //             } else if (full.keterangan_proses == 'Pengembalian') {
            //                 var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' + full.id + '" data-original-title="change" id="changestatus" class="mr-1 change btn btn-info btn-sm">Pengembalian</a>';
            //             };
            //             return status;
            // }},
            { data: 'keterangan_peminjaman', name: 'keterangan_peminjaman' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    });
</script>
@endpush