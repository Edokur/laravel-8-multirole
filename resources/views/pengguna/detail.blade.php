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
        <a href="/pengguna"  data-original-title="kembali" class="btn btn-primary"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="row my-5">
                        <div class="col-md-6 col-12 text-center">
                            <div class="profile-widget-header position-relative d-flex justify-content-center d-flex align-items-end">
                                <img alt="image" src="{{ asset('/') }}assets/img/avatar/avatar-1.png" height="40%" width="40%" class="rounded-circle profile-widget-picture mb-4">
                                {{-- <div class="p-4 btn btn-primary rounded position-absolute rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></div> --}}
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <form class="mx-3">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">No Handphone</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->nohp }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->jenis_kelamin }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Jabatan</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->jabatan }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Role</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->role }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-5">
                                        <input type="text" disabled class="form-control" value="{{ $user->alamat }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Biografi</label>
                                    <div class="col-sm-5">
                                        <textarea name="" id="" cols="27" rows="5" disabled>{{ $user->biografi }}</textarea>
                                        {{-- <input type="text" disabled class="form-control" value="{{ $user->biografi }}"> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection