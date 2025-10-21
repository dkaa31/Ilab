@extends('template.master')
@section('atas', 'Edit Guru')
@section('judul', 'Form Edit Guru')

@section('conten')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Guru</h3>
        </div>
        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap (dengan gelar)</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $guru->nama) }}" placeholder="Contoh: Yusuf Effendy, S.T" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip', $guru->nip) }}" placeholder="Nomor Induk Pegawai" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG (max 2MB)</small>

                    <!-- Preview foto lama -->
                    @if($guru->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" style="height: 100px; object-fit: cover;">
                            <br>
                            <small class="text-muted">Foto saat ini</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection