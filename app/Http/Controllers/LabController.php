<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\Guru;
use Carbon\Carbon;

class LabController extends Controller
{
    //pemilihan lab
    public function selector()
    {
        $ruangans = Ruangan::orderBy('nama')->get();
        return view('lab.selector', compact('ruangans'));
    }

    //dashboard dinamis
    public function show($ruanganId)
    {
        $ruangan = Ruangan::findOrFail($ruanganId);
        
        $hariIni = match(Carbon::now()->dayOfWeek) {
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        };

    //ambil jadwal hari ini
    $jadwalDb = Jadwal::with(['guru', 'mapel', 'ruangan', 'kelase'])
            ->where('hari', $hariIni)
            ->where('ruangan_id', $ruanganId)
            ->orderBy('waktu_mulai')
            ->get();

        $jadwalHarian = $jadwalDb->map(function ($item) {
            return [
                'jamKe' => $item->jam_ke ?? 'Istirahat',
                'waktu' => $item->waktu_mulai . ' - ' . $item->waktu_selesai,
                'guru' => $item->guru?->nama ?? 'Guru Tidak Ada',
                'mapel' => $item->mapel?->nama ?? 'Mapel Tidak Ada',
                'ruangan' => $item->ruangan?->nama ?? 'LAB Tidak Ada',
                'foto' => $item->guru && $item->guru->foto
                    ? asset('storage/' . $item->guru->foto)
                    : asset('storage/default.png'),
            ];
        })->values();

        // Ambil penanggung jawab dari ruangan
        $penanggungJawab = $ruangan->penanggungJawab;

        // Tentukan kelas untuk ditampilkan
        $kelasNama = 'Tidak Ada Kelas';
        if ($jadwalDb->isNotEmpty()) {
            $currentTime = now()->format('H:i');
            $jadwalAktif = null;

            foreach ($jadwalDb as $j) {
                if ($currentTime >= $j->waktu_mulai && $currentTime < $j->waktu_selesai) {
                    $jadwalAktif = $j;
                    break;
                }
            }

            if ($jadwalAktif) {
                $kelasNama = $jadwalAktif->kelase?->nama ?? 'Kelas Tidak Ada';
            } else {
                $kelasNama = $jadwalDb->first()->kelase?->nama ?? 'Kelas Tidak Ada';
            }
        }

        $penanggungjawabLab = [
            'nama' => $penanggungJawab?->nama ?? 'Penanggung Jawab Belum Ditentukan',
            'foto' => $penanggungJawab && $penanggungJawab->foto
                ? asset('storage/' . $penanggungJawab->foto)
                : asset('storage/default.png'),
            'lab' => $ruangan->nama,
            'kelas' => $kelasNama,
        ];

        $jadwalKosong = $jadwalHarian->isEmpty();

        return view('lab.display', compact('jadwalHarian', 'penanggungjawabLab', 'jadwalKosong'));
    }
}
