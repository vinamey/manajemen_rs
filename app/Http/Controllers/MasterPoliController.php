<?php

namespace App\Http\Controllers;

use App\Models\MasterPoli;
use Illuminate\Http\Request;

class MasterPoliController extends Controller
{

    public function index()
    {
        $polis = MasterPoli::latest()->get();

        return view('master-poli.index', compact('polis'));
    }


    public function create()
    {
        return view('master-poli.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
        ]);

        MasterPoli::create([
            'nama_poli' => $request->nama_poli,
        ]);

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $poli = MasterPoli::findOrFail($id);

        return view('master-poli.show', compact('poli'));
    }


    public function edit(string $id)
    {
        $poli = MasterPoli::findOrFail($id);

        return view('master-poli.edit', compact('poli'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
        ]);

        $poli = MasterPoli::findOrFail($id);

        $poli->update([
            'nama_poli' => $request->nama_poli,
        ]);

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $poli = MasterPoli::findOrFail($id);

        $poli->delete();

        return redirect()
            ->route('master-poli.index')
            ->with('success', 'Data poli berhasil dihapus.');
    }
}
