
$(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    var barang_table = $('#barang-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'barang',
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

    $(document).on("click", "#createNewBarang", function() {
        $('#addModalBarangV1').modal('show')
    });

    $("#saveBtnBarang").click(function(e){

        var namaBarang = $("#namaBarang").val();
        var registrasiBarang = $("#registrasiBarang").val();
        var pendistribusianBarang = $("#pendistribusianBarang").val();

        const isFilled = (namaBarang != "" && registrasiBarang != "" && pendistribusianBarang != "");

        e.preventDefault();
        var data = {
            'nama_barang': $("#namaBarang").val(),
            'registrasi_barang': $("#registrasiBarang").val(),
            'pendistribusian_barang': $("#pendistribusianBarang").val(),
        };

        if (isFilled) {
            $.ajax({
                data: data,
                url: "barang/store",
                method: "POST",
                type: 'json',
                success:function(response){
                    if (response.success) {
                        Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                            barang_table.draw();
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

    $('body').on('click', '.deleteBarang', function(){

            var id = {
                'id': $(this).data("id")
            }

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
                        data: id,
                        url: '/barang/delete',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                    barang_table.draw();
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

