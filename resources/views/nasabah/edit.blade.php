
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Nasabah</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control"
                        value="{{ old('nis', $nasabah->nis) }}" required>
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $nasabah->nama) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control"
                        value="{{ old('kelas', $nasabah->kelas) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $nasabah->alamat) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="{{ old('no_hp', $nasabah->no_hp) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

                <a href="{{ route('nasabah.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
