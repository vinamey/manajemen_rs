<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPoli;
use Illuminate\Http\Request;

class MasterDokterController extends Controller
{
    public function index()
    {
        $dokters = MasterDokter::with('poli')
            ->latest()
            ->get();

        return view('master_dokters.index', compact('dokters'));
    }

    public function create()
    {
        $polis = MasterPoli::all();

        return view('master_dokters.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required',
            'spesialis'     => 'required',
            'poli_id'       => 'required',
        ]);

        MasterDokter::create([
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
            'spesialis'     => $request->spesialis,
            'poli_id'       => $request->poli_id,
        ]);

        return redirect()
            ->route('master-dokters.index')
            ->with('success', 'Data dokter berhasil disimpan!');
    }

    public function edit($id)
    {
        $dokter = MasterDokter::findOrFail($id);
        $polis = MasterPoli::all();

        return view(
            'master_dokters.edit',
            compact('dokter', 'polis')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required',
            'spesialis'     => 'required',
            'poli_id'       => 'required',
        ]);

        $dokter = MasterDokter::findOrFail($id);

        $dokter->update([
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
            'spesialis'     => $request->spesialis,
            'poli_id'       => $request->poli_id,
        ]);

        return redirect()
            ->route('master-dokters.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        return redirect()
            ->route('master-dokters.index')
            ->with('success', 'Data dokter berhasil dihapus!');
    }
}
