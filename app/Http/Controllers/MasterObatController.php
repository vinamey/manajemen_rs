<?php

namespace App\Http\Controllers;

use App\Models\MasterObat;
use App\Models\MasterKategori;
use App\Models\MasterSatuanObat;
use Illuminate\Http\Request;

class MasterObatController extends Controller
{
    public function index()
    {
        $obats = MasterObat::latest()->get();

        return view('master-obat.index', compact('obats'));
    }

    public function create()
{
    $kategoris = MasterKategori::orderBy('nama_kategori')->get();
    $satuans = MasterSatuanObat::orderBy('nama')->get();

    return view('master-obat.create', compact('kategoris', 'satuans'));
}

    public function store(Request $request)
{
    $request->validate([
        'kode_obat' => 'required|string|max:50|unique:master_obats,kode_obat',
        'nama_obat' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'satuan' => 'required|string|max:100',
        'harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
    ]);

    MasterObat::create([
        'kode_obat' => $request->kode_obat,
        'nama_obat' => $request->nama_obat,
        'kategori' => $request->kategori,
        'satuan' => $request->satuan,
        'harga' => $request->harga,
        'stok' => $request->stok,
    ]);

    return redirect()
        ->route('master-obat.index')
        ->with('success', 'Data obat berhasil ditambahkan.');
}

    public function show(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        return view('master-obat.show', compact('obat'));
    }

    public function edit(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        return view('master-obat.edit', compact('obat'));
    }

    public function update(Request $request, string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $request->validate([
            'kode_obat' => 'required|string|max:50|unique:master_obats,kode_obat,' . $obat->id,
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'satuan' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $obat->update([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $obat->delete();

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}