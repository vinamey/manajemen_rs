<?php

namespace App\Http\Controllers;

use App\Models\MasterPasien;
use Illuminate\Http\Request;

class MasterPasienController extends Controller
{
    public function index()
    {
        $pasiens = MasterPasien::latest()->get();

        return view('master_pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('master_pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'status_asuransi' => 'required|in:01,0',
            'golongan_darah' => 'required|in:A,B,AB,O',
        ]);

        MasterPasien::create($validated);

        return redirect()
            ->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        return view('master_pasien.show', compact('pasien'));
    }

    public function edit(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        return view('master_pasien.edit', compact('pasien'));
    }

    public function update(Request $request, string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'status_asuransi' => 'required|in:01,0',
            'golongan_darah' => 'required|in:A,B,AB,O',
        ]);

        $pasien->update($validated);

        return redirect()
            ->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        $pasien->delete();

        return redirect()
            ->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
