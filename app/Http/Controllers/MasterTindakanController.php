<?php

namespace App\Http\Controllers;

use App\Models\MasterTindakan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MasterTindakanController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER TINDAKAN
     * =========================================================
     */
    public function index()
    {
        return view('master-tindakan.index');
    }


    /**
     * =========================================================
     * DATA YAJRA
     * =========================================================
     */
    public function data()
    {
        $tindakans = MasterTindakan::query()
            ->select([
                'id',
                'kode',
                'nama',
            ])
            ->orderByDesc('id');

        return DataTables::of($tindakans)

            ->addIndexColumn()

            ->addColumn('aksi', function ($tindakan) {

                return '
                    <div class="d-flex justify-content-center gap-1">

                        <button
                            type="button"
                            class="btn btn-sm btn-action-view-tindakan"
                            title="Lihat"
                        >
                            <i class="fas fa-eye me-1"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-edit-tindakan"
                            title="Edit"
                        >
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-delete-tindakan"
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
        return view('master-tindakan.create');
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
                    'Kode tindakan wajib diisi.',

                'kode.max' =>
                    'Kode tindakan maksimal 255 karakter.',

                'nama.required' =>
                    'Nama tindakan wajib diisi.',

                'nama.max' =>
                    'Nama tindakan maksimal 255 karakter.',
            ]);


            $tindakan = MasterTindakan::create([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data tindakan berhasil ditambahkan.',
                'data' => $tindakan,
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
                    'Terjadi kesalahan saat menyimpan data tindakan.',
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

            $tindakan = MasterTindakan::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $tindakan,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data tindakan tidak ditemukan.',
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

            $tindakan = MasterTindakan::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $tindakan,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data tindakan tidak ditemukan.',
            ], 404);
        }
    }


    /**
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update(
        Request $request,
        string $id
    ) {
        try {

            $tindakan =
                MasterTindakan::findOrFail($id);


            $validated = $request->validate([
                'kode' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
            ], [
                'kode.required' =>
                    'Kode tindakan wajib diisi.',

                'kode.max' =>
                    'Kode tindakan maksimal 255 karakter.',

                'nama.required' =>
                    'Nama tindakan wajib diisi.',

                'nama.max' =>
                    'Nama tindakan maksimal 255 karakter.',
            ]);


            $tindakan->update([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data tindakan berhasil diperbarui.',
                'data' => $tindakan,
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
                    'Terjadi kesalahan saat memperbarui data tindakan.',
            ], 500);
        }
    }


    /**
     * =========================================================
     * HAPUS
     * =========================================================
     */
    public function destroy(string $id)
    {
        try {

            $tindakan =
                MasterTindakan::findOrFail($id);

            $tindakan->delete();


            return response()->json([
                'success' => true,
                'message' =>
                    'Data tindakan berhasil dihapus.',
            ]);

        } catch (QueryException $e) {

            if ((string) $e->getCode() === '23000') {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Data tindakan tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }


            return response()->json([
                'success' => false,
                'message' =>
                    'Gagal menghapus data tindakan.',
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data tindakan tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
