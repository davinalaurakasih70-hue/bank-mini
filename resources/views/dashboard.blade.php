
@extends('layouts.app')

@section('title', 'Dashboard Bank Mini')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Dashboard Bank Mini
    </h1>

    <div class="row">

        <!-- Card Nasabah -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Manajemen Nasabah
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Data Nasabah
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('nasabah.index') }}" class="btn btn-primary btn-sm mt-3">
                        Lihat Data Nasabah
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Rekening -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Manajemen Rekening
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Data Rekening
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <span class="text-muted small mt-3 d-block">
                        Fitur belum tersedia
                    </span>
                </div>
            </div>
        </div>

        <!-- Card Transaksi -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Aktivitas Bank
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Transaksi
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <span class="text-muted small mt-3 d-block">
                        Fitur belum tersedia
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Selamat Datang di Bank Mini Sekolah
            </h6>
        </div>
        <div class="card-body">
            <p>
                Sistem Informasi Bank Mini Sekolah digunakan untuk
                mengelola data nasabah, rekening, transaksi, dan laporan.
            </p>
            <p class="mb-0">
                Silakan pilih menu di sebelah kiri untuk mulai menggunakan sistem.
            </p>
        </div>
    </div>

</div>

@endsection
