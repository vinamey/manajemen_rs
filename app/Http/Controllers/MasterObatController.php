<?php

namespace App\Http\Controllers;

use App\Models\MasterObat;
use App\Models\MasterKategori;
use App\Models\MasterSatuanObat;
use Illuminate\Http\Request;

class MasterObatController extends Controller
{
    // MENAMPILKAN DATA OBAT
    public function index()
    {
        $obats = MasterObat::latest()->get();
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();
        $satuans = MasterSatuanObat::orderBy('nama', 'asc')->get();

        return view('master-obat.index', compact(
            'obats',
            'kategoris',
            'satuans'
        ));
    }

    // HALAMAN TAMBAH OBAT
    public function create()
{
    $obats = MasterObat::orderBy('nama')->get();

    $kategoris = MasterKategori::orderBy('nama')->get();

    return view('master-obat.create', compact(
        'obats',
        'kategoris'
    ));
}

    // MENYIMPAN DATA OBAT
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'kategori_id' => 'required|exists:master_kategoris,id',
    ]);

    MasterObat::create([
        'nama' => $request->nama,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect()
        ->route('master-obat.index')
        ->with('success', 'Data obat berhasil ditambahkan.');
}
    // MELIHAT DETAIL OBAT
    public function show(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        return view('master-obat.show', compact('obat'));
    }

    // HALAMAN EDIT OBAT
    public function edit(string $id)
    {
        $obat = MasterObat::findOrFail($id);
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();
        $satuans = MasterSatuanObat::orderBy('nama', 'asc')->get();

        return view('master-obat.edit', compact(
            'obat',
            'kategoris',
            'satuans'
        ));
    }

    // MEMPERBARUI DATA OBAT
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

    // MENGHAPUS DATA OBAT
    public function destroy(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $obat->delete();

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}
