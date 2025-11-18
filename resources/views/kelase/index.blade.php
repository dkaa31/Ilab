@extends('template.master')
@section('atas', 'Data Kelas')
@section('judul', 'Daftar Kelas')

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Kelas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelases as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->waliKelas->nama ?? '–' }}</td>
                        <td>
                            <a href="{{ route('kelas.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kelas.destroy', $r->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
        </div>
    </div>
</div>
@endsection