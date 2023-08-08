<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
    </form>
    <ul class="navbar-nav navbar-right">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        @if ( auth()->user()->photo != null)
        <img src="../assets/profile/{{ auth()->user()->photo }}" class="rounded-circle mr-1" alt="image">
        @else
          <img src="https://via.placeholder.com/500" class="rounded-circle mr-1" alt="image">
        @endif
        {{-- <img alt="image" src="{{ asset('/') }}assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
        <div class="d-sm-none d-lg-inline-block" style="color: black">Hi, {{ auth()->user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="dropdown-item has-icon text-danger">
              <i class="fas fa-sign-out-alt mt-2"></i> <p style="font-size: 14px">Logout</p>
            </button>
          </form>
        </div>
      </li>
    </ul>
  </nav>