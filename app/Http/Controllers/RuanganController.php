<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::with('penanggungJawab')->orderBy('nama')->get();
        return view('ruangan.index', compact('ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('ruangan.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:ruangans,nama',
            'lokasi' => 'nullable|string',
            'penanggung_jawab_id' => 'required|exists:gurus,id',
        ]);

        Ruangan::create($request->only('nama', 'lokasi', 'penanggung_jawab_id'));

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        $gurus = Guru::all();
        return view('ruangan.edit', compact('ruangan', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:ruangans,nama,' . $ruangan->id,
            'lokasi' => 'nullable|string',
            'penanggung_jawab_id' => 'required|exists:gurus,id',
        ]);

        $ruangan->update($request->only('nama', 'lokasi', 'penanggung_jawab_id'));

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
