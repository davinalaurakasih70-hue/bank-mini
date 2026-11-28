@extends('layouts.app')

@section('title', 'Data Rekening')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Rekening</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Rekening Nasabah</h6>
            <form method="GET" action="{{ route('rekening.index') }}" class="form-inline">
                <input type="text" name="search" class="form-control form-control-sm mr-2" placeholder="Cari..." value="{{ $search ?? '' }}">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th><th>No Rekening</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Saldo</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekenings as $rek)
                            <tr>
                                <td>{{ $rekenings->firstItem() + $loop->index }}</td>
                                <td><span class="badge badge-light border font-weight-bold">{{ $rek->no_rekening }}</span></td>
                                <td>{{ $rek->nasabah->nis ?? '-' }}</td>
                                <td><strong>{{ $rek->nasabah->nama ?? '-' }}</strong></td>
                                <td>{{ $rek->nasabah->kelas ?? '-' }}</td>
                                <td class="font-weight-bold text-primary">Rp {{ number_format($rek->saldo, 0, ',', '.') }}</td>
                                <td><span class="badge badge-{{ $rek->status === 'aktif' ? 'success' : 'secondary' }}">{{ ucfirst($rek->status) }}</span></td>
                                <td>
                                    <a href="{{ route('rekening.show', $rek->id) }}" class="btn btn-info btn-sm">Mutasi</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">Belum ada data rekening.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $rekenings->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
