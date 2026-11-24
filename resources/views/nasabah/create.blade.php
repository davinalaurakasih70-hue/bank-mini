
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Nasabah</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('nasabah.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>NIS</label>
                    <input type="text" name="nis"
                        class="form-control"
                        value="{{ old('nis') }}" required>
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama"
                        class="form-control"
                        value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas"
                        class="form-control"
                        value="{{ old('kelas') }}" required>
                    @error('kelas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp') }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('nasabah.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
