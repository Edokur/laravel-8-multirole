
$(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#pengguna-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'pengguna',
        columns: [
            { data: 'no', name:'id', className: 'text-center', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'is_active', name: 'status', render:function (data, type, full, meta) {
                if (full.is_active == 1) {
                    // var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' +full.id +'" data-original-title="change" data-value="' +full.is_active +'" id="changestatus" class="mr-1 change btn btn-warning btn-sm changestatus">Aktif</a>';
                    var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' +full.id +'" data-original-title="change" data-value="' +full.is_active +'" id="changestatus" class="mr-1 change  changestatus"><input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" checked><span class="custom-switch-indicator"></span></a>';
                } else if (full.is_active == 0) {
                    // var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' + full.id + '" data-original-title="change" data-value="' +full.is_active +'" id="changestatus" class="mr-1 change btn btn-danger btn-sm changestatus">Nonaktif</a>';
                    var status = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' + full.id + '" data-original-title="change" data-value="' +full.is_active +'" id="changestatus" class="mr-1 change changestatus"><input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"><span class="custom-switch-indicator"></span></a>';
                };
                return status;
            }},
            { data: 'nohp', name: 'nohp'},
            { data: 'role', name: 'role', orderable: false, searchable: false},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('body').on('click', '.changestatus', function() {
        var update = {
            'status': $(this).data('value'),
            'id': $(this).data('id')
        };

        $.ajax({
            type: 'ajax',
            method: 'POST',
            data: update,
            url: 'pengguna/changestatus',
            success: function(response) {
                console.log(response);
                table.draw();
            },
            error: function(xmlresponse) {
                console.log(xmlresponse);
            }
    
        })
    });

    $("#createNewPengguna").click(function(){
        $('#penggunaForm').trigger("reset");
        $('#addModalPengguna').modal('show');
    });

    $("#saveBtn").click(function(e){

        var name = $("#namePengguna").val();
        var username = $("#usernamePengguna").val();
        var email = $("#emailPengguna").val();
        var jabatan = $("#jabatanPengguna").val();
        var jenis_kelamin = $("#jkPengguna").val();
        var nohp = $("#nohpPengguna").val();
        var role = $("#rolePengguna").val();
        var alamat = $("#alamatPengguna").val();

        const isFilled = (name != "" && username != "" && email != "" && jabatan != "" && jenis_kelamin != "" && nohp != "" && role != "" && alamat != "");

        e.preventDefault();
        var data = {
            'name': $("#namePengguna").val(),
            'username': $("#usernamePengguna").val(),
            'email': $("#emailPengguna").val(),
            'jabatan': $("#jabatanPengguna").val(),
            'jenis_kelamin': $("#jkPengguna").val(),
            'nohp': $("#nohpPengguna").val(),
            'role': $("#rolePengguna").val(),
            'alamat': $("#alamatPengguna").val(),
        };

        if (isFilled) {
            $.ajax({
                data: data,
                url: "pengguna/store",
                method: "POST",
                type: 'json',
                success:function(response){
                    // console.log(response)
                    if (response.success) {
                        Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                            table.draw();
                            location.reload();
                            // $("#penggunaForm").trigger("reset");
                            // $("#penggunaForm")[0].reset();
                            // reload_table();
                            // $( '#penggunaForm' ).each(function(){
                            //     $(this).reset();
                            // });
                            // $('#penggunaForm')[0].reset();
                            // $('#addModalPengguna').each(function() {
                            //     $(this).modal('hide');
                            // });
                            // $('#addModalPengguna').modal('hide');
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

    $('body').on('click', '.editPengguna', function(){
        var pengguna_id = $(this).data("id");
        $.ajax({
            url: 'pengguna/edit/' + pengguna_id,
            method: "GET",
            type: 'json',
            cache: false,
            success:function(response){
                console.log(response.data);

                $('#EidPengguna').val(response.data.id);
                //fill data to form
                $('#EnamePengguna').val(response.data.name);
                $('#EusernamePengguna').val(response.data.username);
                $('#EemailPengguna').val(response.data.email);
                $('#EjabatanPengguna').val(response.data.jabatan);
                $('#EjkPengguna').val(response.data.jenis_kelamin);
                $('#ErolePengguna').val(response.data.role).change();
                $('#EnohpPengguna').val(response.data.nohp);
                $('#EalamatPengguna').val(response.data.alamat);

                //open modal
                $('#editModalPengguna').modal('show');
            }
        });
    });

    $("#EsaveBtn").click(function(e){
        var name = $("#EnamePengguna").val();
        var username = $("#EusernamePengguna").val();
        var email = $("#EemailPengguna").val();
        var jabatan = $("#EjabatanPengguna").val();
        var jkPengguna = $("#EjkPengguna").val();
        var nohp = $("#EnohpPengguna").val();
        var role = $("#ErolePengguna").val();
        var alamat = $("#EalamatPengguna").val();

        const isFilled = (name != "" && username != "" && email != "" && jabatan != "" && jkPengguna != "" && nohp != "" && role != "" && alamat != "");
        e.preventDefault();

        var data = {
            'id': $("#EidPengguna").val(),
            'name': $("#EnamePengguna").val(),
            'username': $("#EusernamePengguna").val(),
            'email': $("#EemailPengguna").val(),
            'jabatan': $("#EjabatanPengguna").val(),
            'jenis_kelamin': $("#EjkPengguna").val(),
            'nohp': $("#EnohpPengguna").val(),
            'role': $("#ErolePengguna").val(),
            'alamat': $("#EalamatPengguna").val(),
        };

        if (isFilled) {
            $.ajax({
                data: data,
                url: "pengguna/update",
                method: "POST",
                type: 'json',
                success:function(response){
                    console.log(response)
                    if (response.success) {
                        Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                            table.draw();
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

    $('body').on('click', '.deletePengguna', function(){
        var pengguna_id = $(this).data("id");
        console.log(pengguna_id);

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
                    data: pengguna_id,
                    url: 'pengguna/destroy/'+pengguna_id,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                table.draw();
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

