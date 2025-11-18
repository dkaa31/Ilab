@extends('template.master')
@section('atas', 'Tambah Kelas')
@section('judul', 'Form Tambah Kelas')

@section('conten')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Kelas</h3>
        </div>
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" placeholder="Contoh: LAB 2" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="wali_kelas_id">Wali Kelas</label>
                    <select name="wali_kelas_id" class="form-control @error('wali_kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $g)
                            <option value="{{ $g->id }}" {{ old('wali_kelas_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('wali_kelas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection