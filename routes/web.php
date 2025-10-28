<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TampilanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', fn () => view('login.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'check_role:murid,admin,guru']], function () {
    Route::get('/lab', [TampilanController::class, 'index'])->name('lab.display');
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
    // Jadwal per hari
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/filter', [JadwalController::class, 'filter'])->name('jadwal.filter');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
});