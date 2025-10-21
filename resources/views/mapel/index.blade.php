@extends('template.master')
@section('atas', 'Data Mapel')
@section('judul', 'Daftar Mata Pelajaran')

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Mapel</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapels as $i => $m)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $m->kode ?? '–' }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>
                            <a href="{{ route('mapel.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <a href="{{ route('mapel.create') }}" class="btn btn-primary">Tambah Mapel</a>
        </div>
    </div>
</div>
@endsection