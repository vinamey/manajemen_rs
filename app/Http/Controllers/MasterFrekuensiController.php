<?php

namespace App\Http\Controllers;

use App\Models\MasterFrekuensi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterFrekuensiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN MASTER FREKUENSI
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('master-frekuensi.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DATA YAJRA
    |--------------------------------------------------------------------------
    */
    public function data()
    {
        $frekuensis = MasterFrekuensi::query()
            ->select([
                'id',
                'nama',
                'created_at',
            ])
            ->orderByDesc('id');

        return DataTables::of($frekuensis)

            ->addIndexColumn()

            ->addColumn('aksi', function ($row) {

                return '
                    <button
                        type="button"
                        class="btn btn-warning btn-sm"
                        onclick="editData(' . (int) $row->id . ')"
                    >
                        <i class="fas fa-edit"></i>
                        Edit
                    </button>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="hapusData(' . (int) $row->id . ')"
                    >
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                ';
            })

            ->rawColumns([
                'aksi'
            ])

            ->make(true);
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama frekuensi wajib diisi.',
            'nama.max' => 'Nama frekuensi maksimal 255 karakter.',
        ]);

        try {

            $frekuensi = MasterFrekuensi::create([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data frekuensi berhasil ditambahkan.',
                'data' => [
                    'id' => $frekuensi->id,
                    'nama' => $frekuensi->nama,
                ],
            ], 201);

        } catch (\Throwable $e) {

            \Log::error('Gagal menyimpan Master Frekuensi', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data frekuensi gagal disimpan.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL DATA
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $frekuensi = MasterFrekuensi::query()
            ->select([
                'id',
                'nama',
                'created_at',
            ])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $frekuensi,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama frekuensi wajib diisi.',
            'nama.max' => 'Nama frekuensi maksimal 255 karakter.',
        ]);

        try {

            $frekuensi = MasterFrekuensi::findOrFail($id);

            $frekuensi->update([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data frekuensi berhasil diperbarui.',
                'data' => [
                    'id' => $frekuensi->id,
                    'nama' => $frekuensi->nama,
                ],
            ]);

        } catch (\Throwable $e) {

            \Log::error('Gagal memperbarui Master Frekuensi', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data frekuensi gagal diperbarui.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {

            $frekuensi = MasterFrekuensi::findOrFail($id);

            $frekuensi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data frekuensi berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {

            \Log::error('Gagal menghapus Master Frekuensi', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data frekuensi gagal dihapus.',
            ], 500);
        }
    }
}
