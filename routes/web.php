<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TampilanController;

// Guru
Route::resource('guru', GuruController::class);

// Mapel
Route::resource('mapel', MapelController::class);

// Ruangan
Route::resource('ruangan', RuanganController::class);

// Jadwal per hari
Route::get('jadwal/{hari}', [JadwalController::class, 'index'])->name('jadwal.hari');
Route::get('jadwal/{hari}/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('jadwal/{hari}', [JadwalController::class, 'store'])->name('jadwal.store');
Route::get('jadwal/{hari}/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::put('jadwal/{hari}/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('jadwal/{hari}/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

// tampilan lab
Route::get('/lab', [TampilanController::class, 'index'])->name('lab.display');