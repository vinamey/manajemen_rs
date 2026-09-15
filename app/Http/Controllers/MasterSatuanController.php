<?php

namespace App\Http\Controllers;

use App\Models\MasterSatuanObat;
use Illuminate\Http\Request;

class MasterSatuanController extends Controller
{
    public function index()
    {
        $satuans = MasterSatuanObat::latest()->get();

        return view('master-satuan.index', compact('satuansObat'));
    }

    // TAMBAH
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $satuan = MasterSatuanObat::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data satuan obat berhasil ditambahkan.',
            'data' => $satuan
        ]);
    }

    // LIHAT DETAIL
    public function show($id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $satuan
        ]);
    }

    // EDIT
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $satuan = MasterSatuanObat::findOrFail($id);

        $satuan->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data satuan obat berhasil diperbarui.',
            'data' => $satuan
        ]);
    }

    // HAPUS
    public function destroy($id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        $satuan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data satuan obat berhasil dihapus.'
        ]);
    }
}