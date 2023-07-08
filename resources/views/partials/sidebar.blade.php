<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/dashboard">Beecons</a>
      </div>
      {{-- <?= dd($title); ?> --}}
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">BC</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">DASHBOARD</li>
          <li class="{{ ($title == 'Dashboard') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

          <li class="menu-header">DATA</li>
          @if (auth()->user()->role=="Admin")
            <li class="{{ ($title == 'Data Pengguna') ? 'active' : '' }}"><a class="nav-link" href="/pengguna"><i class="fas fa-columns"></i> <span>Data Pengguna</span></a></li>
          @endif
          <li class="{{ ($title == 'Data Peminjaman') ? 'active' : '' }}"><a class="nav-link" href="/peminjaman"><i class="far fa-square"></i> <span>Data Peminjaman</span></a></li>
          <li class="{{ ($title == 'Data Barang') ? 'active' : '' }}"><a class="nav-link" href="/barang"><i class="fas fa-th"></i> <span>Data Barang</span></a></li>
          @if (auth()->user()->role=="Admin")
          <li class="{{ ($title == 'Data Perhitungan') ? 'active' : '' }}"><a class="nav-link" href="/perhitungan"><i class="fas fa-th-large"></i> <span>Data Perhitungan</span></a></li>
          @endif
          
          <li class="menu-header">PROFILE</li>
          <li class="{{ ($title == 'Profile') ? 'active' : '' }}"><a class="nav-link" href="/profile"><i class="far fa-user"></i> <span>Profile</span></a></li>
          @if (auth()->user()->role=="Admin")
          <li class="{{ ($title == 'Keranjang Pinjam') ? 'active' : '' }}"><a class="nav-link" href="/keranjang"><i class="far fa-user"></i> <span>Keranjang Pinjam</span></a></li>
          @endif
      </ul>
    </aside>
  </div>
