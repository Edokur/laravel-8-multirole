$(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
    

    $(document).ready(function() {
        // $('.bio-summernote').summernote();
        $('.bio-summernote').summernote('code', "");
    });
    
    
    $("#saveProfile").click(function(e){
    
        var id = $("#idProfile").val();
        var name = $("#nameProfile").val();
        var username = $("#usernameProfile").val();
        var jabatan = $("#jabatanProfile").val();
        var nohp = $("#nohpProfile").val();
        var alamat = $("#alamatProfile").val();
        var biografi = $("#biografiProfile").val();
    
        const isFilled = (name != "" && username != "" && jabatan != "" && nohp != "" && alamat != "" && biografi != "");
    
        e.preventDefault();
        var data = {
            'id': $("#idProfile").val(),
            'name': $("#nameProfile").val(),
            'username': $("#usernameProfile").val(),
            'email': $("#emailPengguna").val(),
            'jabatan': $("#jabatanProfile").val(),
            'nohp': $("#nohpProfile").val(),
            'alamat': $("#alamatProfile").val(),
            'biografi': $("#biografiProfile").val(),
        };
        if (isFilled) {
            $.ajax({
                data: data,
                url: "/profile/update",
                method: "POST",
                type: 'json',
                success:function(response){
                    console.log(response)
                    if (response.success) {
                        Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
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
                text: 'Terdapat data yang masih kosong',
            })
        }
    });
    
    
    $('#form-foto').submit(function(e) {
        var form = $('#form-foto')[0];
        var data = new FormData(form);
        e.preventDefault();
        $.ajax({
            type: 'ajax',
            method: 'POST',
            url: 'profile/changefoto',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    Swal.fire('Proses berhasil!', response.message, 'success').then(function() {
                        window.location.reload();
                    })
                } else {
                    Swal.fire('Proses berhasil!', response.message, 'success');
                }
            },
            error: function(xmlresponse) {
                console.log(xmlresponse);
            },
        });
    })
    
    $("#changepassword").click(function(e){
    
        var id = $("#idUser").val();
        var passwordLama = $("#passwordLamaUser").val();
        var passwordBaru = $("#passwordBaruUser").val();
        var konfirmasiPassword = $("#konfirmasiPasswordUser").val();

    
        const isFilled = (id != "" && passwordLama != "" && passwordBaru != "" && konfirmasiPassword != "");
    
        e.preventDefault();
        var data = {
            'id': $("#idUser").val(),
            'passwordLama': $("#passwordLamaUser").val(),
            'passwordBaru': $("#passwordBaruUser").val(),
            'konfirmasiPassword': $("#konfirmasiPasswordUser").val(),
        };
        if (isFilled) {
            $.ajax({
                data: data,
                url: "/profile/changepassword",
                method: "POST",
                type: 'json',
                success:function(response){
                    console.log(response)
                    if (response.success) {
                        Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
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
                text: 'Terdapat data yang masih kosong',
            })
        }
    });
});

function changeFoto() {
    $('#modal-foto').modal('show');
    $('.file-name').text('');
    $('#file-preview').html('');
}