<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;

class MasterPerawatController extends Controller
{
    public function index()
    {
        $perawats = MasterPerawat::latest()->get();

        return view('master-perawat.index', compact('perawats'));
    }

    public function create()
    {
        return view('master-perawat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Jenis_Kelamin' => 'required|in:laki-laki,perempuan',
            'Tanggal_Lahir' => 'required|date',
            'Alamat' => 'required|string',
        ]);

        MasterPerawat::create([
            'Nama' => $request->Nama,
            'Jenis_Kelamin' => $request->Jenis_Kelamin,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Alamat' => $request->Alamat,
        ]);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);

        return view('master-perawat.show', compact('perawat'));
    }

    public function edit(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);

        return view('master-perawat.edit', compact('perawat'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Jenis_Kelamin' => 'required|in:laki-laki,perempuan',
            'Tanggal_Lahir' => 'required|date',
            'Alamat' => 'required|string',
        ]);

        $perawat = MasterPerawat::findOrFail($id);

        $perawat->update([
            'Nama' => $request->Nama,
            'Jenis_Kelamin' => $request->Jenis_Kelamin,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Alamat' => $request->Alamat,
        ]);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);

        $perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }
}