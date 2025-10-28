@extends('template.master')
@section('atas')
    Jadwal
@endsection

@section('judul')
    Jadwal
@endsection

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jadwal</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jadwal.filter') }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-4">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" class="form-control" required>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $h)
                            <option value="{{ $h }}" {{ (session('filter_hari') == $h) ? 'selected' : '' }}>
                                {{ $h }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ruangan_id" class="form-label">Ruangan</label>
                    <select name="ruangan_id" class="form-control">
                        <option value="">Semua Lab</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ (session('filter_ruangan_id') == $r->id) ? 'selected' : '' }}>
                                {{ $r->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>

            <hr>

            <h4>{{ session('filter_hari') }} 
                @if(session('filter_ruangan_id'))
                    - {{ $ruangans->firstWhere('id', session('filter_ruangan_id'))?->nama }}
                @endif
            </h4>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Jam Ke</th>
                        <th>Waktu</th>
                        <th>Guru</th>
                        <th>Mapel</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwals as $j)
                    <tr>
                        <td>{{ $j->jam_ke }}</td>
                        <td>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}</td>
                        <td>{{ $j->guru?->nama ?? '–' }}</td>
                        <td>{{ $j->mapel?->nama ?? 'Istirahat' }}</td>
                        <td>{{ $j->ruangan->nama }}</td>
                        <td>
                            <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>
        </div>
    </div>
</div>
@endsection