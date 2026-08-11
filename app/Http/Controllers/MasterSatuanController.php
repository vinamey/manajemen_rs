<?php

namespace App\Http\Controllers;

use App\Models\MasterSatuanObat;
use Illuminate\Http\Request;

class MasterSatuanController extends Controller
{

    public function index()
    {
        $satuans = MasterSatuanObat::latest()->get();

        return view('master-satuan.index', compact('satuans'));
    }


    public function create()
    {
        return view('master-satuan.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:255',
        ]);

        MasterSatuanObat::create([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect()
            ->route('master-satuan.index')
            ->with('success', 'Data satuan obat berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        return view('master-satuan.show', compact('satuan'));
    }


    public function edit(string $id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        return view('master-satuan.edit', compact('satuan'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:255',
        ]);

        $satuan = MasterSatuanObat::findOrFail($id);

        $satuan->update([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect()
            ->route('master-satuan.index')
            ->with('success', 'Data satuan obat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        $satuan->delete();

        return redirect()
            ->route('master-satuan.index')
            ->with('success', 'Data satuan obat berhasil dihapus.');
    }
}
