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
    <div class="row">
      <div class="col-12">
        <div class="card">
          @if(count($keranjang) != 0)
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="keranjang-table">
                <thead>
                  <tr>
                    <th class="text-center">
                      No
                    </th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Spesifikasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang as $item)
                    <tr>
                      <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah_pinjaman }}</td>
                        <td>{{ $item->kondisi_barang }}</td>
                        <td>{{ $item->spesifikasi_barang }}</td>
                        <td>
                          <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteKeranjang" data-id="{{ $item->id }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                {!! $keranjang->links() !!} 
              </div>
              <button type="button" type="submit" id="createPeminjaman" value="create" class="btn btn-warning btn-sm float-right">Ajukan Peminjaman</button>
            </div>
          </div>
          @else
          <div class="mt-5 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" height="10em" viewBox="0 0 576 512"><style>svg{fill:#6777ef}</style><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            <h3 class="mt-4"><b> Wah, keranjang pinjamanmu kosong</b></h3>
            <h6 class="mb-3">Yuk, isi dengan barang-barang yang ingin kamu pinjam!</h6>
          </div>
          @endif
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="addajukanKeranjang" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="KeranjangForm" name="KeranjangForm" class="form-horizontal">
          <div class="form-group">
            <label for="Name">Tanggal Pengembalian<span class="text-danger">*</span></label>
            <p class="text-small">Barang Hanya dapat dipinjam Maksimal Selama 10 Hari</p>
            <input type="text" class="form-control datepicker" name="tgl_kembali" id="tgl_kembali" placeholder="Masukkan Tanggal pengembalian">
          </div>
          <div class="form-group">
            <label for="Name">Keterangan Peminjaman <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="keterangan_pinjam" id="keterangan_pinjam" placeholder="Masukkan Keterangan">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="ajukanKeranjang" value="create" class="btn btn-primary">Kirim Permintaan</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('script')
<script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#createPeminjaman").click(function(){
            $('#KeranjangForm').trigger("reset");
            $('#addajukanKeranjang').modal('show');
        });        

        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy/mm/dd",
            startDate: '0d',
            endDate: '+10d'
          });

        $('body').on('click', '.deleteKeranjang', function(){
            var id_keranjang = {
                'id_keranjang': $(this).data("id")
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
                        data: id_keranjang,
                        url: '{!! url()->current() !!}/delete_keranjang',
                        success: function(response) {
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
                    })
                }
            })
        });

        $('body').on('click', '#ajukanKeranjang', function(){
            var data = {
                'keterangan_pinjam' : $("#keterangan_pinjam").val(),
                'tgl_kembali' : $("#tgl_kembali").val(),
            }

            Swal.fire({
                icon: 'info',
                title: 'Mohon Perhatian !',
                text: 'Ingin melakukan peminjaman Barang Tersebut, apakah anda yakin ?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pinjam !',
                confirmButtonColor: '#007AFF',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#d33',
                reverseButtons: true,
            }).then(function(isvalid) {
                if (isvalid.value) {
                    $.ajax({
                        type: 'ajax',
                        method: 'POST',
                        data: data,
                        url: '{!! url()->current() !!}/ajukan_keranjang',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                    location.reload();
                                })
                            } else {
                                Swal.fire('Proses Gagal!', response.message, 'error');
                            }
                        },
                        error: function(xmlresponse) {
                          Swal.fire({
                              confirmButtonColor: '#3ab50d',
                              icon: 'error',
                              title: 'Peringatan',
                              text: 'Isian bertanda bintang wajib diisi',
                          });
                        }
                    })
                }
            })
        });

      });
</script>
@endpush