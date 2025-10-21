@extends('template.master')
@section('atas', 'Edit Mata Pelajaran')
@section('judul', 'Form Edit Mapel')

@section('conten')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Mata Pelajaran</h3>
        </div>
        <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Mata Pelajaran</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $mapel->nama) }}" placeholder="Contoh: Pemrograman Perangkat Bergerak" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kode">Kode (opsional)</label>
                    <input type="text" name="kode" class="form-control" value="{{ old('kode', $mapel->kode) }}">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection