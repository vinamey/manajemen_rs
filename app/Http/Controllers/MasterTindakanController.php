<?php

namespace App\Http\Controllers;

use App\Models\MasterTindakan;
use Illuminate\Http\Request;

class MasterTindakanController extends Controller
{
    
    public function index()
    {
        $tindakans = MasterTindakan::latest()->get();

        return view('master-tindakan.index', compact('tindakans'));
    }


    public function create()
    {
        return view('master-tindakan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        MasterTindakan::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-tindakan.index')
            ->with('success', 'Data tindakan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $tindakan = MasterTindakan::findOrFail($id);

        return view('master-tindakan.show', compact('tindakan'));
    }


    public function edit(string $id)
    {
        $tindakan = MasterTindakan::findOrFail($id);

        return view('master-tindakan.edit', compact('tindakan'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $tindakan = MasterTindakan::findOrFail($id);

        $tindakan->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-tindakan.index')
            ->with('success', 'Data tindakan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $tindakan = MasterTindakan::findOrFail($id);

        $tindakan->delete();

        return redirect()
            ->route('master-tindakan.index')
            ->with('success', 'Data tindakan berhasil dihapus.');
    }
}
