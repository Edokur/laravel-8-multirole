<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="pengajuan-table">
                <thead>
                    <tr>
                        <th class="text-center">
                        No
                        </th>
                        <th>Kode Peminjaman</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Transaksi</th>
                        <th>Terlambat</th>
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


@push('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
        });

        var pengajuan_table = $('#pengajuan-table').DataTable({
            "autoWidth": false,
            processing: true,
            serverSide: true,
            ajax: 'pengajuan_table_pegawai',
            columns: [
                { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'kode_pinjam', name: 'kode_pinjam' },
                { data: 'tgl_pinjam', name: 'tgl_pinjam' },
                { data: 'tgl_kembali', name: 'tgl_kembali' },
                { data: 'status', name: 'status', render:function (data, type, full, meta) {
                    if (full.status == 'Diproses') {
                        var status = '<span class="badge badge-warning">Diproses</span>';
                    }
                    return status;
                }},
                { data: 'keterangan_proses', name: 'keterangan_proses', render:function (data, type, full, meta) {
                    if (full.keterangan_proses == 'Peminjaman') {
                        var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' +full.id +'" data-original-title="change"  id="changestatus" class="mr-1 change btn btn-success btn-sm">Peminjaman</a>';
                    } else if (full.keterangan_proses == 'Pengembalian') {
                        var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' + full.id + '" data-original-title="change" id="changestatus" class="mr-1 change btn btn-info btn-sm">Pengembalian</a>';
                    };
                    return status;
                }},
                { data: 'terlambat', name: 'terlambat' , render:function (data, type, full, meta) {
                    return full.terlambat +' Hari';
                }},
                { data: 'keterangan_peminjaman', name: 'keterangan_peminjaman' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush