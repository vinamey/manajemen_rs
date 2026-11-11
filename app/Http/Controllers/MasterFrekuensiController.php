<?php

namespace App\Http\Controllers;

use App\Models\MasterFrekuensi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterFrekuensiController extends Controller
{
    // HALAMAN MASTER FREKUENSI
    public function index()
    {
        return view('master-frekuensi.index');
    }

    // MENGAMBIL DATA UNTUK DATATABLE
    public function data()
    {
        $frekuensis = MasterFrekuensi::query()
            ->select(['id', 'kode', 'nama', 'created_at']);

        return DataTables::of($frekuensis)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <button type="button" class="btn btn-warning btn-sm"
                        onclick="editData(' . $row->id . ')">
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="hapusData(' . $row->id . ')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // MENYIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        MasterFrekuensi::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data frekuensi berhasil ditambahkan.'
        ]);
    }

    // MENGAMBIL DATA UNTUK EDIT
    public function show($id)
    {
        $frekuensi = MasterFrekuensi::findOrFail($id);

        return response()->json($frekuensi);
    }

    // MEMPERBARUI DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $frekuensi = MasterFrekuensi::findOrFail($id);

        $frekuensi->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data frekuensi berhasil diperbarui.'
        ]);
    }

    // MENGHAPUS DATA
    public function destroy($id)
    {
        $frekuensi = MasterFrekuensi::findOrFail($id);
        $frekuensi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data frekuensi berhasil dihapus.'
        ]);
    }
}