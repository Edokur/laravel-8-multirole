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
        <a href="/peminjaman"  data-original-title="kembali" class="btn btn-primary mb-3"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Kembali</a><br>

        <div class="card">
            <div class="card-body">
                <form action="#">
                    @foreach ($peminjaman as $item)
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-2 col-form-label col-form-label-sm">Nama Peminjaman</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" value="{{ $item->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-2 col-form-label col-form-label-sm">No Peminjaman</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" value="{{ $item->kode_pinjam }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-2 col-form-label col-form-label-sm">Tanggal Peminjaman</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" value="{{ $item->tgl_pinjam }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-2 col-form-label col-form-label-sm">Tanggal Pengembalian</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" value="{{ $item->tgl_kembali }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-2 col-form-label col-form-label-sm">Keterangan Peminjaman</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-plaintext" value="{{ $item->keterangan_peminjaman }}" readonly>
                        </div>
                    </div>
                    @endforeach
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
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
                          <th>Jumlah Peminjaman</th>
                          <th>Kondisi</th>
                          <th>Spesifikasi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @for ($i = 0; $i < count($barang); $i++)
                        <tr>
                            <td class="text-center">{{ ++$no }}</td>
                              <td>{{ $barang[$i][0]->kode_barang}}</td>
                              <td>{{ $barang[$i][0]->nama_barang }}</td>
                              <td>{{ $pinjaman[$i][0] }}</td>
                              <td>{{ $barang[$i][0]->kondisi_barang }}</td>
                              <td>{{ $barang[$i][0]->spesifikasi }}</td>
                            </tr>
                        @endfor
                        </tbody>
                      </table>
                    </div>
                    <form action="#">
                        @foreach ($peminjaman as $item)
                        <input type="hidden" name="kode_pinjam" id="kode_pinjam" value="{{ $item->kode_pinjam }}">
                        <input type="hidden" name="id_pinjam" id="id_pinjam" value="{{ $item->id }}">
                        <input type="hidden" name="keterangan_proses" id="keterangan_proses" value="{{ $item->keterangan_proses }}">
                        @endforeach
                    </form>
                    <button type="submit" id="terimaPengembalian" class="btn btn-success float-right mr-3">Selesai Digunakan</button>
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

        $("#terimaPengembalian").click(function(e){
            e.preventDefault();
            var data = {
                'kode_pinjam': $("#kode_pinjam").val(),
                'id_pinjam': $("#id_pinjam").val(),
                'keterangan_proses': $("#keterangan_proses").val(),
            };

            $.ajax({
                    data: data,
                    url: "{!! url()->current() !!}/terimaPengembalian",
                    method: "POST",
                    type: 'json',
                    success:function(response){
                        console.log(response)
                        if (response.success) {
                            Swal.fire('Proses Berhasil!', response.message, 'success').then(function() {
                                window.location.href = "{{ route('peminjaman.admin')}}";
                            })
                        } else {
                            Swal.fire('Proses Gagal!', response.message, 'error');
                        }
                    },
                    error: function(xmlresponse) {
                        console.log(xmlresponse);
                    }
                });

            });

    });
</script>
@endpush