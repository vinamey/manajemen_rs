<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use Illuminate\Http\Request;

class MasterDokterController extends Controller
{
    public function index()
    {
        $dokters = MasterDokter::latest()->get();

        return view('master-dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('master-dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'spesialis' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        MasterDokter::create([
            'kode_dokter' => $request->kode_dokter,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'spesialis' => $request->spesialis,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        return view('master-dokter.show', compact('dokter'));
    }

    public function edit(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        return view('master-dokter.edit', compact('dokter'));
    }

    public function update(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $request->validate([
            'kode_dokter' => 'required|string|max:255|unique:master_dokters,kode_dokter,' . $id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'spesialis' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $dokter->update([
            'kode_dokter' => $request->kode_dokter,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'spesialis' => $request->spesialis,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }
}