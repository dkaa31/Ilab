@extends('template.master')

@section('atas')
Dashboard - Laboratorium
@endsection

@section('judul')
Dashboard
@endsection

@section('conten')
<div class="col-12">
  <div class="row">
    <!-- Card Guru -->
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $jumlahGuru }}</h3>
          <p>Guru</p>
        </div>
        <div class="icon">
          <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <a href="{{ route('guru.index') }}" class="small-box-footer">
          Lihat Detail <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Card Mapel -->
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $jumlahMapel }}</h3>
          <p>Mata Pelajaran</p>
        </div>
        <div class="icon">
          <i class="fas fa-book-open"></i>
        </div>
        <a href="{{ route('mapel.index') }}" class="small-box-footer">
          Lihat Detail <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Card Ruang -->
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $jumlahRuangan }}</h3>
          <p>Ruangan</p>
        </div>
        <div class="icon">
          <i class="fas fa-door-open"></i>
        </div>
        <a href="{{ route('ruangan.index') }}" class="small-box-footer">
          Lihat Detail <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Card Info Tambahan (Bisa dikembangkan) -->
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $jumlahUser }}</h3>
          <p>User</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <a href="{{ route('user.index') }}" class="small-box-footer">
          Lihat Detail <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>


    <div class="col-md-3 col-sm-6 mb-3">
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3>{{ $jumlahKelas }}</h3>
          <p>Kelas</p>
        </div>
        <div class="icon">
          <i class="fas fa-school"></i>
        </div>
        <a href="{{ route('kelas.index') }}" class="small-box-footer">
          Lihat Detail <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- Bisa tambahkan grafik, jadwal hari ini, atau notifikasi di sini nanti -->
</div>
@endsection