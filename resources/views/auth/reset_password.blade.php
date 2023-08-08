@extends('auth.main')
@section('content')
{{-- <?= dd($token); ?> --}}
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
          <img src="{{ asset('/') }}assets/img/logo-beecon.png" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-warning">
          <div class="card-header"><h4>Reset Password</h4></div>

          <div class="card-body">
            <p class="text-muted">We will send a link to reset your password</p>
            <form method="POST" action="{{ route('reset.post') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                @if ($errors->has('password_confirmation'))
                  <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                  Reset Password
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; Caraka Tech 2023
        </div>
      </div>
    </div>
  </div>
</section>

@endsection