<?php

namespace App\Http\Controllers;

use App\Models\MasterAsuransi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MasterAsuransiController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER ASURANSI
     * =========================================================
     */
    public function index()
    {
        return view('master-asuransi.index');
    }


    /**
     * =========================================================
     * DATA YAJRA
     * =========================================================
     */
    public function data()
    {
        $asuransis = MasterAsuransi::query()
            ->select([
                'id',
                'kode',
                'nama',
            ])
            ->orderByDesc('id');

        return DataTables::of($asuransis)

            ->addIndexColumn()

            ->addColumn('aksi', function ($asuransi) {

                return '
                    <div class="d-flex justify-content-center gap-1">

                        <button
                            type="button"
                            class="btn btn-sm btn-action-view-asuransi"
                            title="Lihat"
                        >
                            <i class="fas fa-eye me-1"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-edit-asuransi"
                            title="Edit"
                        >
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-delete-asuransi"
                            title="Hapus"
                        >
                            <i class="fas fa-trash me-1"></i>
                            Hapus
                        </button>

                    </div>
                ';
            })

            ->rawColumns([
                'aksi'
            ])

            ->make(true);
    }


    /**
     * =========================================================
     * CREATE
     * =========================================================
     */
    public function create()
    {
        return view('master-asuransi.create');
    }


    /**
     * =========================================================
     * SIMPAN DATA
     * =========================================================
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'kode' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
            ], [
                'kode.required' =>
                    'Kode Asuransi wajib diisi.',

                'kode.max' =>
                    'Kode Asuransi maksimal 255 karakter.',

                'nama.required' =>
                    'Jenis Asuransi wajib dipilih.',

                'nama.max' =>
                    'Jenis Asuransi maksimal 255 karakter.',
            ]);


            $asuransi = MasterAsuransi::create([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data asuransi berhasil ditambahkan.',
                'data' => $asuransi,
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Terjadi kesalahan saat menyimpan data asuransi.',
            ], 500);
        }
    }


    /**
     * =========================================================
     * DETAIL
     * =========================================================
     */
    public function show(string $id)
    {
        try {

            $asuransi = MasterAsuransi::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $asuransi,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data asuransi tidak ditemukan.',
            ], 404);
        }
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(string $id)
    {
        try {

            $asuransi = MasterAsuransi::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $asuransi,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data asuransi tidak ditemukan.',
            ], 404);
        }
    }


    /**
     * =========================================================
     * UPDATE DATA
     * =========================================================
     */
    public function update(
        Request $request,
        string $id
    ) {
        try {

            $asuransi =
                MasterAsuransi::findOrFail($id);


            $validated = $request->validate([
                'kode' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
            ], [
                'kode.required' =>
                    'Kode Asuransi wajib diisi.',

                'kode.max' =>
                    'Kode Asuransi maksimal 255 karakter.',

                'nama.required' =>
                    'Jenis Asuransi wajib dipilih.',

                'nama.max' =>
                    'Jenis Asuransi maksimal 255 karakter.',
            ]);


            $asuransi->update([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data asuransi berhasil diperbarui.',
                'data' => $asuransi,
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Terjadi kesalahan saat memperbarui data asuransi.',
            ], 500);
        }
    }


    /**
     * =========================================================
     * HAPUS DATA
     * =========================================================
     */
    public function destroy(string $id)
    {
        try {

            $asuransi =
                MasterAsuransi::findOrFail($id);

            $asuransi->delete();


            return response()->json([
                'success' => true,
                'message' =>
                    'Data asuransi berhasil dihapus.',
            ]);

        } catch (QueryException $e) {

            if ((string) $e->getCode() === '23000') {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Data asuransi tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }


            return response()->json([
                'success' => false,
                'message' =>
                    'Gagal menghapus data asuransi.',
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data asuransi tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
