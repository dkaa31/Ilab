<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Kelase;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahGuru = Guru::count();
        $jumlahMapel = Mapel::count();
        $jumlahRuangan = Ruangan::count();
        $jumlahUser = User::count();
        $jumlahKelas = Kelase::count();

        return view('dashboard.index', compact('jumlahGuru', 'jumlahMapel', 'jumlahRuangan', 'jumlahUser', 'jumlahKelas'));
    }
}
