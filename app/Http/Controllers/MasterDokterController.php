<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPoli;
use Illuminate\Http\Request;

class MasterDokterController extends Controller
{
    public function index()
    {
        $dokters = MasterDokter::latest()->get();
        $polis = MasterPoli::orderBy('nama')->get();

        return view('master-dokter.index', compact('dokters', 'polis'));
    }

    public function create()
    {
        return view('master-dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'nullable|exists:master_poli,id',
        ]);

        $dokter = MasterDokter::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil ditambahkan.',
            'data' => $dokter,
        ]);
    }

    public function show(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        return view('master-dokter.show', compact('dokter'));
    }

    public function edit(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $dokter,
            ]);
        }

        return view('master-dokter.edit', compact('dokter'));
    }

    public function update(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Spesialis TIDAK dimasukkan ke validasi update
        | supaya tidak bisa diubah.
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'poli_id' => 'nullable|exists:master_poli,id',
        ]);

        $dokter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil diperbarui.',
            'data' => $dokter->fresh(),
        ]);
    }

    public function destroy(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil dihapus.',
        ]);
    }
}
