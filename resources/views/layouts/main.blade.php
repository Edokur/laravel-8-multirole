<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }}</title>
  <link href='{{ asset('/') }}assets/img/logo-beecon.png' rel='shortcut icon'>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('/') }}assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <!-- Template CSS -->
  {{-- <link rel="stylesheet" href="../assets/css/style.css"> --}}
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/components.css">
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css">
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/html5-qrcode-css.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      
      @include('partials.navbar')
      @include('partials.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> Design By <a href="https://github.com/Edokur">Caraka Tech</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('/') }}assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('/') }}assets/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="{{ asset('/') }}assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.1/html5-qrcode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

  <!-- Template JS File -->
  <script src="{{ asset('/') }}assets/js/html5-qrcode-css.js"></script>
  <script src="{{ asset('/') }}assets/js/scripts.js"></script>
  <script src="{{ asset('/') }}assets/js/custom.js"></script>
  {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}

  <!-- Page Specific JS File -->
  <script src="{{ asset('/') }}assets/js/pengguna.js"></script>
  <script src="{{ asset('/') }}assets/js/profile.js"></script>
  {{-- <script src="{{ asset('/') }}assets/js/barang_detail.js"></script> --}}
  {{-- <script src="{{ asset('/') }}assets/js/perhitungan.js"></script> --}}
  @stack('script')
  
</body>
</html>
