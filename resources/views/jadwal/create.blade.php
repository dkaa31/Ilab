@extends('template.master')
@section('atas', "Tambah Jadwal - $hari")
@section('judul', "Form Tambah Jadwal ($hari)")

@section('conten')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Jadwal Hari {{ $hari }}</h3>
        </div>
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            {{-- Kirim hari via hidden input --}}
            <input type="hidden" name="hari" value="{{ $hari }}">

            <div class="card-body">
                <div class="form-group">
                    <label for="jam_ke">Jam Ke</label>
                    <input type="text" name="jam_ke" class="form-control @error('jam_ke') is-invalid @enderror"
                        value="{{ old('jam_ke') }}" placeholder="Contoh: 1 atau Istirahat" required>
                    @error('jam_ke')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror"
                        value="{{ old('waktu_mulai') }}" required>
                    @error('waktu_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror"
                        value="{{ old('waktu_selesai') }}" required>
                    @error('waktu_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status" required>
                        <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Istirahat" {{ old('status') == 'Istirahat' ? 'selected' : '' }}>Istirahat</option>
                    </select>
                </div>

                <div id="aktif-fields">
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $g)
                                <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mapel_id">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapels as $m)
                                <option value="{{ $m->id }}" {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mapel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kelase_id">Kelas</label>
                        <select name="kelase_id" class="form-control @error('mapel_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelases as $k)
                                <option value="{{ $k->id }}" {{ old('kelase_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelase_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="ruangan_id">Ruangan</label>
                    <select name="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" 
                                {{ (old('ruangan_id', $ruanganId) == $r->id) ? 'selected' : '' }}>
                                {{ $r->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('ruangan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
document.getElementById('status').addEventListener('change', function() {
    const fields = document.getElementById('aktif-fields');
    if (this.value === 'Istirahat') {
        fields.style.display = 'none';
        fields.querySelectorAll('select').forEach(sel => {
            sel.removeAttribute('required');
            sel.value = ''; // opsional: kosongkan saat istirahat
        });
    } else {
        fields.style.display = 'block';
        fields.querySelectorAll('select[name="guru_id"], select[name="mapel_id"]').forEach(sel => {
            sel.setAttribute('required', 'required');
        });
    }
});
// Trigger on load
document.getElementById('status').dispatchEvent(new Event('change'));
</script>
@endpush