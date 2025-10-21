@extends('template.master')
@section('atas')
    Jadwal - {{ $hari }}
@endsection

@section('judul')
    Jadwal Hari {{ $hari }}
@endsection

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jadwal Hari {{ $hari }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                            <a href="{{ route('jadwal.edit', [$hari, $j->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('jadwal.destroy', [$hari, $j->id]) }}" method="POST" style="display:inline;">
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
            <a href="{{ route('jadwal.create', $hari) }}" class="btn btn-primary">Tambah Jadwal</a>
        </div>
    </div>
</div>
@endsection