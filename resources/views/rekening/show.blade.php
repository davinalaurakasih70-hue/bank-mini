@extends('layouts.app')

@section('title', 'Mutasi Rekening')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Buku Tabungan</h1>
        <a href="{{ route('rekening.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted" width="40%">No Rekening</td><td>: <strong>{{ $rekening->no_rekening }}</strong></td></tr>
                        <tr><td class="text-muted">Nama</td><td>: <strong>{{ $rekening->nasabah->nama ?? '-' }}</strong></td></tr>
                        <tr><td class="text-muted">NIS / Kelas</td><td>: {{ $rekening->nasabah->nis ?? '-' }} / {{ $rekening->nasabah->kelas ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6 text-md-right">
                    <span class="text-muted">Saldo Saat Ini:</span>
                    <h2 class="font-weight-bold text-primary">Rp {{ number_format($rekening->saldo, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Mutasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr><th>Tanggal</th><th>Kode</th><th>Jenis</th><th>Keterangan</th><th>Nominal</th></tr>
                    </thead>
                    <tbody>
                        @forelse($rekening->transaksis as $trx)
                            <tr>
                                <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $trx->kode_transaksi }}</td>
                                <td><span class="badge badge-{{ $trx->jenis === 'setoran' ? 'success' : 'danger' }}">{{ strtoupper($trx->jenis) }}</span></td>
                                <td>{{ $trx->keterangan ?? '-' }}</td>
                                <td class="font-weight-bold {{ $trx->jenis === 'setoran' ? 'text-success' : 'text-danger' }}">
                                    {{ $trx->jenis === 'setoran' ? '+' : '-' }} Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">Belum ada mutasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
