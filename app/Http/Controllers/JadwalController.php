<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Ruangan;
use App\Models\Kelase;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
   public function index()
{
    $hari = session('filter_hari', 'Senin'); // default Senin
    $ruanganId = session('filter_ruangan_id');

    $jadwals = Jadwal::with(['guru', 'mapel', 'ruangan', 'kelase'])
        ->where('hari', $hari);

    if ($ruanganId) {
        $jadwals->where('ruangan_id', $ruanganId);
    }

    $jadwals = $jadwals->orderBy('waktu_mulai')->get();

    $ruangans = Ruangan::all();

    return view('jadwal.index', compact('jadwals', 'hari', 'ruangans', 'ruanganId'));
}

// Tambahkan method filter
public function filter(Request $request)
{
    $request->validate([
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
        'ruangan_id' => 'nullable|exists:ruangans,id',
    ]);

    session(['filter_hari' => $request->hari, 'filter_ruangan_id' => $request->ruangan_id]);

    return redirect()->route('jadwal.index');
}

// Ubah create
public function create()
{
    $hari = session('filter_hari', 'Senin');
    $ruanganId = session('filter_ruangan_id');

    $gurus = Guru::all();
    $mapels = Mapel::all();
    $ruangans = Ruangan::all();
    $kelases = Kelase::all();

    return view('jadwal.create', compact('hari', 'ruanganId', 'gurus', 'mapels', 'ruangans', 'kelases'));
}

// Ubah store
public function store(Request $request)
{
    $request->validate([
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
        'jam_ke' => 'required|string|max:20',
        'waktu_mulai' => 'required|date_format:H:i',
        'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        'ruangan_id' => 'required|exists:ruangans,id',
        'status' => 'required|in:Aktif,Istirahat',
    ]);

    $data = [
        'hari' => $request->hari,
        'jam_ke' => $request->jam_ke,
        'waktu_mulai' => $request->waktu_mulai,
        'waktu_selesai' => $request->waktu_selesai,
        'ruangan_id' => $request->ruangan_id,
        'status' => $request->status,
        'guru_id' => null,
        'kelase_id' => null,
        'mapel_id' => null,
    ];

    if ($request->status === 'Aktif') {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kelase_id' => 'required|exists:kelases,id',
            'mapel_id' => 'required|exists:mapels,id',
        ]);
        $data['guru_id'] = $request->guru_id;
        $data['kelase_id'] = $request->kelase_id;
        $data['mapel_id'] = $request->mapel_id;
    }

    Jadwal::create($data);

    // Redirect ke index dengan filter yang sama
    return redirect()->route('jadwal.index')
        ->with('success', 'Jadwal berhasil ditambahkan.')
        ->withInput(['hari' => $request->hari, 'ruangan_id' => $request->ruangan_id]);
}

// Ubah edit
public function edit(Jadwal $jadwal)
{
    $gurus = Guru::all();
    $mapels = Mapel::all();
    $ruangans = Ruangan::all();
    $kelases = Kelase::all();
    $hari = $jadwal->hari; // Ambil hari dari data jadwal

    return view('jadwal.edit', compact('jadwal', 'hari', 'gurus', 'mapels', 'ruangans', 'kelases'));
}

// Ubah update
public function update(Request $request, Jadwal $jadwal)
{
    // Validasi sama seperti store, tapi tanpa hari (karena tidak boleh diubah)
    $request->validate([
        'jam_ke' => 'required|string|max:20',
        'waktu_mulai' => 'required|date_format:H:i',
        'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        'ruangan_id' => 'required|exists:ruangans,id',
        'status' => 'required|in:Aktif,Istirahat',
    ]);

    $data = [
        'jam_ke' => $request->jam_ke,
        'waktu_mulai' => $request->waktu_mulai,
        'waktu_selesai' => $request->waktu_selesai,
        'ruangan_id' => $request->ruangan_id,
        'status' => $request->status,
        'guru_id' => null,
        'kelase_id' => null,
        'mapel_id' => null,
    ];

    if ($request->status === 'Aktif') {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kelase_id' => 'required|exists:kelases,id',
            'mapel_id' => 'required|exists:mapels,id',
        ]);
        $data['guru_id'] = $request->guru_id;
        $data['kelase_id'] = $request->kelase_id;
        $data['mapel_id'] = $request->mapel_id;
    }

    $jadwal->update($data);

    return redirect()->route('jadwal.index')
        ->with('success', 'Jadwal berhasil diperbarui.')
        ->withInput(['hari' => $jadwal->hari, 'ruangan_id' => $jadwal->ruangan_id]);
}

// Ubah destroy
public function destroy(Jadwal $jadwal)
{
    $jadwal->delete();

    return redirect()->route('jadwal.index')
        ->with('success', 'Jadwal berhasil dihapus.');
}
}