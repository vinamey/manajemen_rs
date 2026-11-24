<?php

namespace App\Http\Controllers;

use App\Models\MasterTindakan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MasterTindakanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN MASTER TINDAKAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('master-tindakan.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DATA YAJRA
    |--------------------------------------------------------------------------
    */
    public function data()
    {
        $tindakans = MasterTindakan::query()
            ->select([
                'id',
                'nama',
            ])
            ->orderByDesc('id');

        return DataTables::of($tindakans)

            ->addIndexColumn()

            ->addColumn('aksi', function ($tindakan) {

                $id = (int) $tindakan->id;

                return '
                    <div class="d-flex justify-content-center gap-1">

                        <button
                            type="button"
                            class="btn btn-sm btn-action-view-tindakan"
                            data-id="' . $id . '"
                            title="Lihat"
                        >
                            <i class="fas fa-eye me-1"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-edit-tindakan"
                            data-id="' . $id . '"
                            title="Edit"
                        >
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-action-delete-tindakan"
                            data-id="' . $id . '"
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


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('master-tindakan.create');
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
        'nama.required' => 'Nama tindakan wajib diisi.',
        'nama.max' => 'Nama tindakan maksimal 255 karakter.',
    ]);

    try {

        $tindakan = MasterTindakan::create([
            'nama' => $validated['nama'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data tindakan berhasil ditambahkan.',
            'data' => [
                'id' => $tindakan->id,
                'nama' => $tindakan->nama,
            ],
        ], 201);

    } catch (\Throwable $e) {

        \Log::error('Gagal menyimpan Master Tindakan', [
            'message' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Data tindakan gagal disimpan.',
        ], 500);
    }
}

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */
    public function show(string $id)
    {
        try {

            $tindakan = MasterTindakan::query()
                ->select([
                    'id',
                    'nama',
                ])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $tindakan,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data tindakan tidak ditemukan.',
            ], 404);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(string $id)
    {
        try {

            $tindakan = MasterTindakan::query()
                ->select([
                    'id',
                    'nama',
                ])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $tindakan,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data tindakan tidak ditemukan.',
            ], 404);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, string $id)
    {
        try {

            $tindakan = MasterTindakan::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
            ], [
                'nama.required' => 'Nama tindakan wajib diisi.',
                'nama.max' => 'Nama tindakan maksimal 255 karakter.',
            ]);

            $tindakan->update([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data tindakan berhasil diperbarui.',
                'data' => [
                    'id' => $tindakan->id,
                    'nama' => $tindakan->nama,
                ],
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            \Log::error('Gagal memperbarui Master Tindakan', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data tindakan.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */
    public function destroy(string $id)
    {
        try {

            $tindakan = MasterTindakan::findOrFail($id);

            $tindakan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data tindakan berhasil dihapus.',
            ]);

        } catch (QueryException $e) {

            if ((string) $e->getCode() === '23000') {

                return response()->json([
                    'success' => false,
                    'message' => 'Data tindakan tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data tindakan.',
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data tindakan tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
