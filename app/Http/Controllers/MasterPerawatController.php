<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;

class MasterPerawatController extends Controller
{
    /**
     * Menampilkan semua data perawat.
     */
    public function index()
    {
        $perawats = MasterPerawat::latest()->get();

        return view('master-perawat.index', compact('perawats'));
    }

    /**
     * Menampilkan form tambah perawat.
     */
    public function create()
    {
        return view('master-perawat.create');
    }

    /**
     * Menyimpan data perawat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        MasterPerawat::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail perawat.
     */
    public function show(MasterPerawat $master_perawat)
    {
        return view('master-perawat.show', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Menampilkan form edit perawat.
     */
    public function edit(MasterPerawat $master_perawat)
    {
        return view('master-perawat.edit', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Mengupdate data perawat.
     */
    public function update(Request $request, MasterPerawat $master_perawat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $master_perawat->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    /**
     * Menghapus data perawat.
     */
    public function destroy(MasterPerawat $master_perawat)
    {
        $master_perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }
}
