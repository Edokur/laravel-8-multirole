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

    {{-- @if (auth()->user()->role=="Admin") --}}
  {{-- {{ auth()->user()->name }} --}}
  {{-- <<?= dd(auth()->user()); ?> --}}
      <div class="card">
        <div class="card-header">
          <h4>Accordion Halaman Peminjaman</h4>
        </div>
        <div class="card-body">
          <div id="accordion">
            <div class="accordion">
              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                <h4>Panel 1</h4>
              </div>
              <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
            <div class="accordion">
              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                <h4>Panel 2</h4>
              </div>
              <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
            <div class="accordion">
              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                <h4>Panel 3</h4>
              </div>
              <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
    
@endsection