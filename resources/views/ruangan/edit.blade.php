@extends('template.master')
@section('atas', 'Edit Ruangan')
@section('judul', 'Form Edit Ruangan')

@section('conten')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Ruangan</h3>
        </div>
        <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Ruangan</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $ruangan->nama) }}" placeholder="Contoh: LAB 2" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="penanggung_jawab_id">Penanggung Jawab</label>
                    <select name="penanggung_jawab_id" class="form-control @error('penanggung_jawab_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $g)
                            <option value="{{ $g->id }}" {{ (old('penanggung_jawab_id', $ruangan->penanggung_jawab_id) == $g->id) ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('penanggung_jawab_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection