<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bank Mini Sekolah')</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon"><i class="fas fa-landmark"></i></div>
            <div class="sidebar-brand-text mx-2">BANK MINI</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Manajemen Bank</div>

        <li class="nav-item {{ request()->is('nasabah*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('nasabah.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Nasabah</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('rekening*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('rekening.index') }}">
                <i class="fas fa-fw fa-wallet"></i>
                <span>Data Rekening</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('transaksi*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.index') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
                <span class="font-weight-bold text-primary">Sistem Informasi Bank Mini</span>
                <div class="ml-auto">
                    <span class="text-gray-600">Administrator</span>
                </div>
            </nav>
            @yield('content')
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="text-center my-auto">
                    <span>Bank Mini Sekolah &copy; 2026</span>
                </div>
            </div>
        </footer>
    </div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
