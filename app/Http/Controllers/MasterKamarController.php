<?php

namespace App\Http\Controllers;

use App\Models\MasterKamar;
use Illuminate\Http\Request;

class MasterKamarController extends Controller
{
    // 1. TAMPILKAN DATA
    public function index()
    {
        $kamars = MasterKamar::latest()->get();
        return view('master-kamar.index', compact('kamars'));
    }

    // 2. SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'kode'   => 'required|unique:master_kamars,kode',
            'nama'   => 'required',
            'status' => 'required',
        ]);

        MasterKamar::create([
            'kode'   => $request->kode,
            'nama'   => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data kamar berhasil ditambahkan!');
    }

    // 3. UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode'   => 'required|unique:master_kamars,kode,'.$id,
            'nama'   => 'required',
            'status' => 'required',
        ]);

        $kamar = MasterKamar::findOrFail($id);
        $kamar->update([
            'kode'   => $request->kode,
            'nama'   => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data kamar berhasil diperbarui!');
    }

    // 4. HAPUS DATA
    public function destroy($id)
    {
        $kamar = MasterKamar::findOrFail($id);
        $kamar->delete();

        return redirect()->back()->with('success', 'Data kamar berhasil dihapus!');
    }
}
