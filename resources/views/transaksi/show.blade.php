@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Bukti Transaksi</h6>
                    <a href="{{ route('transaksi.struk', $transaksi->id) }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fas fa-print mr-1"></i> Cetak Struk
                    </a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">BANK MINI SEKOLAH</div>
                        <h4 class="font-weight-bold mb-0">{{ $transaksi->kode_transaksi }}</h4>
                        <small class="text-muted">{{ $transaksi->created_at->format('d F Y - H:i:s') }}</small>
                    </div>

                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted" width="40%">Jenis</td>
                            <td><span class="badge badge-{{ $transaksi->jenis === 'setoran' ? 'success' : 'danger' }}">{{ strtoupper($transaksi->jenis) }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">No Rekening</td>
                            <td class="font-weight-bold">{{ $transaksi->rekening->no_rekening }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Nasabah</td>
                            <td class="font-weight-bold">{{ $transaksi->rekening->nasabah->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIS / Kelas</td>
                            <td>{{ $transaksi->rekening->nasabah->nis }} / {{ $transaksi->rekening->nasabah->kelas }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Keterangan</td>
                            <td>{{ $transaksi->keterangan ?? '-' }}</td>
                        </tr>
                        <tr class="border-top">
                            <td class="font-weight-bold h5">Jumlah</td>
                            <td class="font-weight-bold h5 {{ $transaksi->jenis === 'setoran' ? 'text-success' : 'text-danger' }}">
                                Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Saldo Akhir</td>
                            <td class="font-weight-bold text-primary h6">Rp {{ number_format($transaksi->rekening->saldo, 0, ',', '.') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('transaksi.create') }}" class="btn btn-success">Transaksi Lagi</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
