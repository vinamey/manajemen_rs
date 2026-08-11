<?php

namespace App\Http\Controllers;

use App\Models\MasterAsuransi;
use Illuminate\Http\Request;

class MasterAsuransiController extends Controller
{

    public function index()
    {
        $asuransis = MasterAsuransi::latest()->get();

        return view('master-asuransi.index', compact('asuransis'));
    }


    public function create()
    {
        return view('master-asuransi.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        MasterAsuransi::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-asuransi.index')
            ->with('success', 'Data asuransi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $asuransi = MasterAsuransi::findOrFail($id);

        return view('master-asuransi.show', compact('asuransi'));
    }


    public function edit(string $id)
    {
        $asuransi = MasterAsuransi::findOrFail($id);

        return view('master-asuransi.edit', compact('asuransi'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $asuransi = MasterAsuransi::findOrFail($id);

        $asuransi->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('master-asuransi.index')
            ->with('success', 'Data asuransi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $asuransi = MasterAsuransi::findOrFail($id);

        $asuransi->delete();

        return redirect()
            ->route('master-asuransi.index')
            ->with('success', 'Data asuransi berhasil dihapus.');
    }
}
