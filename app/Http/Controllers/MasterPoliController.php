<?php

namespace App\Http\Controllers;

use App\Models\MasterPoli;
use Illuminate\Http\Request;

class MasterPoliController extends Controller
{
    /**
     * Menampilkan semua data poli
     * Data terbaru ditampilkan paling atas
     */
    public function index()
    {
        $polis = MasterPoli::orderBy('created_at', 'DESC')->get();

        return view('master-poli.index', compact('polis'));
    }


    /**
     * Menampilkan form tambah
     * Tidak digunakan karena tambah menggunakan modal
     */
    public function create()
    {
        return view('master-poli.create');
    }


    /**
     * Menyimpan data poli baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:master_polis,kode',
            'nama' => 'required',
        ], [
            'kode.required' => 'Kode Poli wajib diisi.',
            'kode.unique' => 'Kode Poli sudah digunakan.',
            'nama.required' => 'Nama Poli wajib diisi.',
        ]);

        MasterPoli::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail data poli
     */
    public function show($id)
    {
        $poli = MasterPoli::findOrFail($id);

        return view('master-poli.show', compact('poli'));
    }


    /**
     * Menampilkan form edit
     * Tidak digunakan karena edit menggunakan modal
     */
    public function edit($id)
    {
        $poli = MasterPoli::findOrFail($id);

        return view('master-poli.edit', compact('poli'));
    }


    /**
     * Mengupdate data poli
     */
    public function update(Request $request, $id)
    {
        $poli = MasterPoli::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:master_polis,kode,' . $poli->id,
            'nama' => 'required',
        ], [
            'kode.required' => 'Kode Poli wajib diisi.',
            'kode.unique' => 'Kode Poli sudah digunakan.',
            'nama.required' => 'Nama Poli wajib diisi.',
        ]);

        $poli->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil diupdate.');
    }


    /**
     * Menghapus data poli
     */
    public function destroy($id)
    {
        $poli = MasterPoli::findOrFail($id);

        $poli->delete();

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil dihapus.');
    }
}
