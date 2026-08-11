<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;

class MasterPerawatController extends Controller
{
    public function index()
    {
        $perawats = MasterPerawat::all();

        return view('master_perawats.index', compact('perawats'));
    }

    public function create()
    {
        return view('master_perawats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        MasterPerawat::create($request->all());

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);

        return view('master_perawats.edit', compact('perawat'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $perawat = MasterPerawat::findOrFail($id);

        $perawat->update($request->all());

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);

        $perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus');
    }
}
