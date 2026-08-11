<?php

namespace App\Http\Controllers;

use App\Models\MasterKamar;
use Illuminate\Http\Request;

class MasterKamarController extends Controller
{
    
    public function index()
    {
        $kamars = MasterKamar::latest()->get();

        return view('master-kamar.index', compact('kamars'));
    }


    public function create()
    {
        return view('master-kamar.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'status' => 'required|in:tersedia,terisi',
        ]);

        MasterKamar::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('master-kamar.index')
            ->with('success', 'Data kamar berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kamar = MasterKamar::findOrFail($id);

        return view('master-kamar.show', compact('kamar'));
    }


    public function edit(string $id)
    {
        $kamar = MasterKamar::findOrFail($id);

        return view('master-kamar.edit', compact('kamar'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $kamar = MasterKamar::findOrFail($id);

        $kamar->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('master-kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kamar = MasterKamar::findOrFail($id);

        $kamar->delete();

        return redirect()
            ->route('master-kamar.index')
            ->with('success', 'Data kamar berhasil dihapus.');
    }
}
