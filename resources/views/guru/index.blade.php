@extends('template.master')
@section('atas', 'Data Guru')
@section('judul', 'Daftar Guru')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('conten')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gurus as $i => $g)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            @if($g->foto)
                                <img src="{{ asset('storage/' . $g->foto) }}" width="50" class="img-circle">
                            @else
                                <span class="text-muted">–</span>
                            @endif
                        </td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->nip }}</td>
                        <td>
                            <a href="{{ route('guru.edit', $g->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('guru.destroy', $g->id) }}" method="POST" style="display:inline;">
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
            <a href="{{ route('guru.create') }}" class="btn btn-primary">Tambah Guru</a>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(function () {
    $(".table").DataTable({ "paging": true, "lengthChange": false, "searching": true, "info": true, "autoWidth": false });
});
</script>
@endpush