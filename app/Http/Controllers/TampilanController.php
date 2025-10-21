<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\Guru;
use Carbon\Carbon;

class TampilanController extends Controller
{
   public function index()
    {
        $hariIni = match(Carbon::now()->dayOfWeek) {
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        };

        $jadwalDb = Jadwal::with(['guru', 'mapel', 'ruangan'])
            ->where('hari', $hariIni)
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

        $penanggungJawab = Guru::whereHas('ruangans', function ($query) {
            $query->where('nama', 'LAB 2');
        })->first();

        $penanggungjawabLab = [
            'nama' => $penanggungJawab?->nama ?? 'Penanggung Jawab Belum Ditentukan',
            'foto' => $penanggungJawab && $penanggungJawab->foto
                ? asset('storage/' . $penanggungJawab->foto)
                : asset('storage/default.png'),
            'lab' => 'LAB 2',
        ];

        $jadwalKosong = $jadwalHarian->isEmpty();

        return view('lab.display', compact('jadwalHarian', 'penanggungjawabLab', 'jadwalKosong'));
    }
}
