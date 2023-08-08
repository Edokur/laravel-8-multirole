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
      <a href="javascript:void(0)" id="createNewPengguna" data-original-title="edit" class="mb-3 btn btn-success">Tambah Pengguna</a>
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header">
              <h4>Basic DataTables</h4>
            </div> --}}
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="pengguna-table">
                  <thead>
                    <tr>
                      <th class="text-center">
                        No
                      </th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>No Hp</th>
                      <th>Role</th>
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
    
{{-- modal tambah pengguna  --}}
<div class="modal fade" id="addModalPengguna" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengguna</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="PenggunaForm" name="PenggunaForm" class="form-horizontal">
          <div class="form-group">
            <label for="Name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="namePengguna" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="Name">Username <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="username" id="usernamePengguna" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="Name">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="email" id="emailPengguna" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="Name">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" name="role" id="jkPengguna">
              <option value="">-- pilih --</option>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Name">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="jabatan" id="jabatanPengguna" placeholder="Enter Jabatan">
          </div>
          <div class="form-group">
            <label for="Name">Role <span class="text-danger">*</span></label>
            <select class="form-control" name="role" id="rolePengguna">
              <option value="">Semua</option>
              <option value="Admin">Admin</option>
              <option value="Pimpinan">Pimpinan</option>
              <option value="Pegawai">Pegawai</option>
          </select>
          </div>
          <div class="form-group">
            <label for="Name">No Hp <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nohp" id="nohpPengguna" placeholder="Enter No HP">
          </div>
          <div class="form-group">
            <label for="Name">Alamat <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="alamat" id="alamatPengguna" placeholder="Enter Alamat">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" type="submit" id="saveBtn" value="create" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

{{-- modal edit pengguna  --}}
<div class="modal fade" id="editModalPengguna" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Pengguna</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="UpdatePenggunaForm" name="PenggunaForm" class="form-horizontal">
          <input type="hidden" name="id" id="EidPengguna">
          <div class="form-group">
            <label for="Name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="EnamePengguna" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="Name">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" id="EusernamePengguna" placeholder="Enter Username" disabled>
          </div>
          <div class="form-group">
            <label for="Name">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="EemailPengguna" placeholder="Enter Email" disabled>
          </div>
          <div class="form-group">
            <label for="Name">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" name="role" id="EjkPengguna">
              <option value="">-- pilih --</option>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Name">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="jabatan" id="EjabatanPengguna" placeholder="Enter Jabatan">
          </div>
          <div class="form-group">
            <label for="Name">Role <span class="text-danger">*</span></label>
            <select class="form-control" name="role" id="ErolePengguna">
              <option value="">Semua</option>
              <option value="Admin">Admin</option>
              <option value="Pimpinan">Pimpinan</option>
              <option value="Pegawai">Pegawai</option>
          </select>
          </div>
          <div class="form-group">
            <label for="Name">No Hp <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="nohp" id="EnohpPengguna" placeholder="Enter No HP">
          </div>
          <div class="form-group">
            <label for="Name">Alamat <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="alamat" id="EalamatPengguna" placeholder="Enter Alamat">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" type="submit" id="EsaveBtn" value="update" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection




