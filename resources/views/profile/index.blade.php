@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Profile</a></div>
        {{-- <div class="breadcrumb-item"><a href="#">{{ $title }}</a></div> --}}
        <div class="breadcrumb-item">{{ $title }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
        <p class="section-lead">Change information about yourself on this page.</p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                <div class="profile-widget-header">
                    @if ( auth()->user()->photo != null)
                        <div class="rounded-circle profile-widget-picture" onclick="changeFoto()">
                            <img src="../assets/profile/{{ auth()->user()->photo }}" class="rounded-circle" width="100vh" height="100vh">
                        </div>
                    @else
                        <a onclick="changeFoto()">
                            <img src="https://via.placeholder.com/500" class="rounded-circle profile-widget-picture" alt="">
                        </a>
                    @endif
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ auth()->user()->name }}<div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ auth()->user()->jabatan }}</div></div>
                    {{ strip_tags(auth()->user()->biografi) }}
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="/profile/update" method="POST" id="ProfileForm" name="ProfileForm" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="id" id="idProfile" value="{{ auth()->user()->id }}">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" id="nameProfile" value="{{ auth()->user()->name }}" required="">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" id="usernameProfile" value="{{ auth()->user()->username }}" required="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7 col-12">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatanProfile" value="{{ auth()->user()->jabatan }}" required="">
                                </div>
                                <div class="form-group col-md-5 col-12">
                                    <label>No Handphone</label>
                                    <input type="number" class="form-control" name="nohp" id="nohpProfile" value="{{ auth()->user()->nohp }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamatProfile" value="{{ auth()->user()->alamat }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Bio</label>
                                    <textarea class="form-control summernote-simple" name="biografi" id="biografiProfile">{{ strip_tags(auth()->user()->biografi) }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success" id="saveProfile">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="/profile/changepassword" method="post">
                        <div class="card-header">
                            <h4 class="text-primary">Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="idUser" id="idUser" value="{{ auth()->user()->id }}">
                                <div class="form-group col-md-6 col-12">
                                    <label>Password Lama</label>
                                    <input type="text" name="passwordLamaUser" id="passwordLamaUser" class="form-control " required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Password Baru</label>
                                    <input type="text" name="passwordBaruUser" id="passwordBaruUser" class="form-control" required="">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="text" name="konfirmasiPasswordUser" id="konfirmasiPasswordUser" class="form-control"required="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-secondary" type="reset" style="color: black">Reset</button>
                            <button class="btn btn-success" type="submit" id="changepassword">Perbarui Password</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>
    
<div class="modal fade" tabindex="-1" id="modal-foto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST"  enctype="multipart/form-data" id="form-foto">
                <div class="modal-header">
                    <b class="modal-title">Ubah Foto Profil</b>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto profil</label>
                        <div>
                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                            <input type="file" name="file_photo" id="file_photo" required class="form-control" >
                            {{-- <span class="file-name text-muted text-bold ml-5"></span>
                            <div id="file-preview"></div>
                            <span class="file-alert-type text-danger text-bold"></span>
                            <span class="file-alert-size text-danger text-bold"></span> --}}
                            <div class="hint-block mt-3">
                                Jenis file yang diijinkan: <strong>JPEG, JPG, PNG</strong> dengan ukuran file maksimal: <strong>2 MB</strong><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                    {{-- {{ __('Upload') }} --}}
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection