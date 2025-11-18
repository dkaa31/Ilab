<?php

namespace App\Http\Controllers;

use App\Models\Kelase;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases = Kelase::with('waliKelas')->orderBy('nama')->get();
        return view('kelase.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('kelase.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kelases,nama',
            'wali_kelas_id' => 'required|exists:gurus,id',
        ]);

        Kelase::create($request->only('nama', 'wali_kelas_id'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelase $kelase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelase $kelase)
    {
        $gurus = Guru::all();
        return view('kelase.edit', compact('kelase', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelase $kelase)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kelases,nama,' . $kelase->id,
            'wali_kelas_id' => 'required|exists:gurus,id',
        ]);

        $kelase->update($request->only('nama', 'wali_kelas_id'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelase $kelase)
    {
        $kelase->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
