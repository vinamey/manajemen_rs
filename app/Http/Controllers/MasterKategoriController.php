<?php

namespace App\Http\Controllers;

use App\Models\MasterKategori;
use Illuminate\Http\Request;

class MasterKategoriController extends Controller
{

    public function index()
    {
        $kategoris = MasterKategori::latest()->get();

        return view('master-kategori.index', compact('kategoris'));
    }


    public function create()
    {
        return view('master-kategori.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    MasterKategori::create([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()
        ->route('master-kategori.index')
        ->with('success', 'Data kategori berhasil ditambahkan.');
}
    public function show(string $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        return view('master-kategori.show', compact('kategori'));
    }


    public function edit(string $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        return view('master-kategori.edit', compact('kategori'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
        ]);

        $kategori = MasterKategori::findOrFail($id);

        $kategori->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-kategori.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('master-kategori.index')
            ->with('success', 'Data kategori berhasil dihapus.');
    }
}
