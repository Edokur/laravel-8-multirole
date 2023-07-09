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
  {{-- {{ auth()->user()->name }} --}}
  {{-- <<?= dd(auth()->user()); ?> --}}
      <p>Halaman Keranjang Pinjam</p>
  </div>
</section>


@endsection

@push('script')
<script></script>
@endpush