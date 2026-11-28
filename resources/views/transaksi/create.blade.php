@extends('layouts.app')

@section('title', 'Input Transaksi')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Transaksi Baru</h6>
                </div>
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Pilih Rekening Nasabah <span class="text-danger">*</span></label>
                            <select name="rekening_id" id="rekening_id" class="form-control" required>
                                <option value="">-- Pilih Rekening --</option>
                                @foreach($rekening as $rek)
                                    <option value="{{ $rek->id }}"
                                            data-saldo="{{ $rek->saldo }}"
                                            data-nama="{{ $rek->nasabah->nama ?? '' }}"
                                            data-kelas="{{ $rek->nasabah->kelas ?? '' }}"
                                            {{ old('rekening_id') == $rek->id ? 'selected' : '' }}>
                                        {{ $rek->no_rekening }} - {{ $rek->nasabah->nama ?? 'Tanpa Nama' }} ({{ $rek->nasabah->kelas ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-info d-none" id="infoBox">
                            <strong>Nama:</strong> <span id="infoNama">-</span> |
                            <strong>Kelas:</strong> <span id="infoKelas">-</span> |
                            <strong>Saldo:</strong> <span id="infoSaldo" class="font-weight-bold text-success">Rp 0</span>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Jenis Transaksi <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis" value="setoran" id="jSetor" {{ old('jenis', 'setoran') === 'setoran' ? 'checked' : '' }}>
                                    <label class="form-check-label text-success font-weight-bold" for="jSetor">SETORAN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis" value="penarikan" id="jTarik" {{ old('jenis') === 'penarikan' ? 'checked' : '' }}>
                                    <label class="form-check-label text-danger font-weight-bold" for="jTarik">PENARIKAN</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 50000" min="1000" step="500" value="{{ old('jumlah') }}" required>
                            <small class="text-muted">Minimal Rp 1.000</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Keterangan (opsional)</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Tabungan mingguan" value="{{ old('keterangan') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check mr-1"></i> Proses Transaksi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var sel = document.getElementById('rekening_id');
    var box = document.getElementById('infoBox');
    sel.addEventListener('change', function() {
        var opt = sel.options[sel.selectedIndex];
        if (opt.value) {
            document.getElementById('infoNama').textContent = opt.getAttribute('data-nama');
            document.getElementById('infoKelas').textContent = opt.getAttribute('data-kelas');
            document.getElementById('infoSaldo').textContent = 'Rp ' + parseFloat(opt.getAttribute('data-saldo')).toLocaleString('id-ID');
            box.classList.remove('d-none');
        } else {
            box.classList.add('d-none');
        }
    });
});
</script>
@endsection
