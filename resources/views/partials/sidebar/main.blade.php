<aside class="main-sidebar sidebar-dark-primary sidebar elevation-3">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-bold"><center>SIM-Perpustakaan</center></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar accent-white">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->getPhoto() }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->username }}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('mdata/mahasiswa/') }}" class="nav-link {{ Request::is('mdata/mahasiswa*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Mahasiswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('mdata/penerbit/') }}" class="nav-link {{ Request::is('mdata/penerbit*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Penerbit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('mdata/buku/') }}" class="nav-link {{ Request::is('mdata/buku*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Buku
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('mdata/parameter/1') }}" class="nav-link {{ Request::is('mdata/parameter/1') ? 'active' : '' }}">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Parameter
              </p>
            </a>
          </li>
          <li class="nav-header">OPERASIONAL</li>
          <li class="nav-item has-treeview {{ Request::is('operational/transaksi*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('operational/transaksi*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('operational/transaksi/') }}" class="nav-link {{ Request::is('operational/transaksi') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('operational/transaksi/add') }}" class="nav-link {{ Request::is('operational/transaksi/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengembalian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Denda
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengembalian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pinjam & Kembali</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Denda</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>