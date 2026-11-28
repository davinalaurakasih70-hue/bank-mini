@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Transaksi Tabungan</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Transaksi Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
            <form method="GET" action="{{ route('transaksi.index') }}" class="form-inline">
                <input type="text" name="search" class="form-control form-control-sm mr-2" placeholder="Cari..." value="{{ $search ?? '' }}">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>No Rekening</th>
                            <th>Nama Siswa</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $item)
                            <tr>
                                <td>{{ $transaksi->firstItem() + $loop->index }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td><span class="badge badge-light border">{{ $item->kode_transaksi }}</span></td>
                                <td>{{ $item->rekening->no_rekening ?? '-' }}</td>
                                <td>{{ $item->rekening->nasabah->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $item->jenis === 'setoran' ? 'success' : 'danger' }}">
                                        {{ strtoupper($item->jenis) }}
                                    </span>
                                </td>
                                <td class="font-weight-bold {{ $item->jenis === 'setoran' ? 'text-success' : 'text-danger' }}">
                                    {{ $item->jenis === 'setoran' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('transaksi.struk', $item->id) }}" target="_blank" class="btn btn-secondary btn-sm">Struk</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $transaksi->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection
