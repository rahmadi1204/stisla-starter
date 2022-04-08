<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">Indesign<b class="text-primary">plant</b></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}"><img src="{{ asset('/storage/images/logo.png') }}" alt="logo"
                    style="max-width: 50px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('/dashboard') }}"><i
                                class="fas fa-chalkboard"></i>Dashboard 1</a></li>
                    <li><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-desktop"></i>Dashboard
                            2</a></li>
                </ul>
            </li>
            <li class="menu-header">Master</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Master</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('user.index') }}"><i
                                class="fas fa-user"></i>Pengguna</a>
                    </li>
                    <li><a class="nav-link" href="#"><i class="fas fa-users"></i>Pelanggan</a>
                    </li>
                    <li><a class="nav-link" href="#"><i class="fas fa-box"></i>Barang</a>
                    </li>
                    <li><a class="nav-link" href="#"><i class="fas fa-truck"></i>Kurir</a>
                    </li>
                    <li><a class="nav-link" href="#"><i class="fas fa-credit-card"></i>Rekening</a></li>
                    <li><a class="nav-link" href="#"><i class="fas fa-exclamation-circle"></i></i>Notifikasi</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box-open"></i>
                    <span>Barang</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#"><i class="fas fa-truck-loading"></i>Masuk</a></li>
                    <li><a class="nav-link" href="#"><i class="fas fa-truck-moving"></i>Keluar</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cash-register"></i>
                    <span>Keuangan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#"><i class="fas fa-money-check-alt"></i>Masuk</a></li>
                    <li><a class="nav-link" href="#"><i class="fas fa-money-bill-wave"></i>Keluar</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-receipt"></i>
                    <span>Tagihan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i>Masuk</a></li>
                    <li><a class="nav-link" href="#"><i class="fas fa-file-invoice"></i>Keluar</a></li>
                </ul>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-window-restore"></i>
                    <span>Barang</span></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-file-alt"></i>
                    <span>Keuangan</span></a>
            </li>
            <li class="menu-header">Admin</li>
            <li><a class="nav-link" href="#"><i class="fas fa-store-alt"></i>
                    <span>Toko</span></a></li>
            <li><a class="nav-link" href="{{ route('role.index') }}"><i class="fas fa-user-secret"></i>
                    <span>Hak Akses</span></a></li>
            <li><a class="nav-link" href="{{ url('logs') }}"><i class="fas fa-file-code"></i>
                    <span>Logs</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://indesignplant.com" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Landing Page
            </a>
        </div>
    </aside>
</div>
