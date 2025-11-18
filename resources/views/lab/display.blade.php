<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Laboratorium</title>
  <link rel="stylesheet" href="{{ asset('css/lab.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
</head>
<body>
  <div class="container">
    <div class="logos">
      <img src="{{ asset('images/pplg.png') }}" alt="Logo PPLG" class="logo" />
      <img src="{{ asset('images/neskar.png') }}" alt="Logo Neskar" class="logo" />
    </div>

    <div class="header">
      <div class="jam"></div>
      <div class="waktu-digital" id="waktu"></div>
      <div class="tanggal" id="tanggal"></div>
    </div>

    <div class="info">
      <img src="{{ $penanggungjawabLab['foto'] }}" alt="Foto Guru" class="foto-guru" id="FotoGuru" />
      <div class="info-lab">
        <div class="waktu"></div>
        <div class="guru"></div>
        <div class="mapel"></div>
      </div>
      <div class="lab-info">
        <div class="lab">{{ $penanggungjawabLab['lab'] }}</div>
        <div class="kelas">{{ $penanggungjawabLab['kelas'] }}</div>
      </div>
    </div>

    <div class="jadwal-container">
      <div class="jadwal-judul"><span>Jadwal Hari Ini</span></div>
      @if($jadwalKosong)
        <div class="jadwal-kosong">
          Tidak ada jadwal hari ini.
        </div>
      @else
        <div class="jadwal-scroll" id="JadwalScroll"></div>
      @endif
    </div>
  </div>

  <script>
    const jadwalHarian = @json($jadwalHarian);
    const penanggungjawabLab = @json($penanggungjawabLab);
    const jadwalKosong = @json($jadwalKosong);
  </script>

  <script src="{{ asset('js/lab.js') }}"></script>
</body>
</html>