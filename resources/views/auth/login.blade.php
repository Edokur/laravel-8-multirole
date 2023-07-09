@extends('auth.main')
@section('content')
    
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('/') }}assets/img/logo-beecon.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            
            <div class="card card-warning">
              <div class="card-header"><h5>Login</h5></div>

                @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>&times;</span>
                    </button>
                    {{ Session::get('message') }}
                  </div>
                </div>
                @endif

                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>&times;</span>
                    </button>
                    {{ Session::get('error') }}
                  </div>
                </div>
                @endif
              <div class="card-body">
                <form method="POST" action="/login" class="needs-validation" >
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="{{ route('forget.get') }}" class="text-small text-warning">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                      <div >LOGIN</div>
                    </button>
                  </div>
                </form>

              </div>
            {{-- </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> --}}
            <div class="simple-footer">
              Copyright &copy; Caraka 2023
            </div>
          </div>
        </div>
      </div>
    </section>

  @endsection