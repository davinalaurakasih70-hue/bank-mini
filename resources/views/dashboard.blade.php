@extends('layouts.app')

@section('title', 'Dashboard Bank Mini')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Bank Mini</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Transaksi Baru
        </a>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Nasabah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNasabah }} Siswa</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rekening Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRekening }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-wallet fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Saldo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-money-bill-wave fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksiHariIni }} Trx</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar-day fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">5 Transaksi Terbaru</h6>
            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-link">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="thead-light">
                        <tr><th>Waktu</th><th>Kode</th><th>Nama</th><th>Jenis</th><th>Nominal</th></tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $trx)
                            <tr>
                                <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $trx->kode_transaksi }}</td>
                                <td>{{ $trx->rekening->nasabah->nama ?? '-' }}</td>
                                <td><span class="badge badge-{{ $trx->jenis === 'setoran' ? 'success' : 'danger' }}">{{ strtoupper($trx->jenis) }}</span></td>
                                <td class="font-weight-bold {{ $trx->jenis === 'setoran' ? 'text-success' : 'text-danger' }}">
                                    {{ $trx->jenis === 'setoran' ? '+' : '-' }} Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
