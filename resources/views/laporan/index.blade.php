@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Laporan Transaksi</h1>
        <a href="{{ route('laporan.cetak', ['tanggal_mulai' => $tanggalMulai, 'tanggal_selesai' => $tanggalSelesai, 'jenis' => $jenis]) }}" target="_blank" class="btn btn-success">
            <i class="fas fa-print mr-1"></i> Cetak Laporan
        </a>
    </div>

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}" class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label class="font-weight-bold">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="font-weight-bold">Sampai Tanggal</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="font-weight-bold">Jenis</label>
                    <select name="jenis" class="form-control">
                        <option value="semua" {{ $jenis === 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="setoran" {{ $jenis === 'setoran' ? 'selected' : '' }}>Setoran</option>
                        <option value="penarikan" {{ $jenis === 'penarikan' ? 'selected' : '' }}>Penarikan</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-filter mr-1"></i> Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Setoran</div>
                    <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Penarikan</div>
                    <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo Bersih</div>
                    <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($saldoBersih, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi</div>
                    <div class="h5 mb-0 font-weight-bold">{{ $totalTransaksi }} Kali</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Trx</th>
                            <th>No Rek</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->rekening->no_rekening ?? '-' }}</td>
                                <td>{{ $item->rekening->nasabah->nama ?? '-' }}</td>
                                <td>{{ $item->rekening->nasabah->kelas ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $item->jenis === 'setoran' ? 'success' : 'danger' }}">
                                        {{ strtoupper($item->jenis) }}
                                    </span>
                                </td>
                                <td class="font-weight-bold {{ $item->jenis === 'setoran' ? 'text-success' : 'text-danger' }}">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">Tidak ada data pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
