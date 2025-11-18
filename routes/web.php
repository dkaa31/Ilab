<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelaseController;
use App\Http\Controllers\LabController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', fn () => view('login.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

route::group(['middleware' =>['auth', 'check_role:admin,guru,murid']], function(){
// Halaman pemilih lab
Route::get('/lab', [LabController::class, 'selector'])->name('lab.selector');
// Dashboard lab dinamis
Route::get('/lab/{ruanganId}', [LabController::class, 'show'])->name('lab.show');
});

route::group(['middleware' =>['auth', 'check_role:admin,guru']], function(){
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Guru
    Route::resource('guru', GuruController::class);
    //user
    Route::resource('user', UserController::class)->names('user');
    // Mapel
    Route::resource('mapel', MapelController::class);
    // Ruangan
    Route::resource('ruangan', RuanganController::class);
    //kelas
    Route::resource('kelas', KelaseController::class)->parameters(['kelas' => 'kelase']);
    // Jadwal per hari
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/filter', [JadwalController::class, 'filter'])->name('jadwal.filter');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
});