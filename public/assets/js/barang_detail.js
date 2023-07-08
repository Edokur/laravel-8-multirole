
$(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $("#idBarang").val();

    var barangDetail_table = $('#Detailbarang_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "barang/detail/"+id,
        columns: [
            { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            // { data: 'name', name: 'name' },
            { data: 'kode_barang', name: 'kode_barang' },
            { data: 'nama_barang', name: 'nama_barang'},
            { data: 'brand_barang', name: 'brand_barang'},
            { data: 'harga_barang', name: 'harga_barang'},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

});

