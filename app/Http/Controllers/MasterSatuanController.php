<?php

namespace App\Http\Controllers;

use App\Models\MasterSatuanObat;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MasterSatuanController extends Controller
{
    /**
     * HALAMAN MASTER SATUAN
     */
    public function index()
    {
        return view('master-satuan.index');
    }

    /**
     * DATA YAJRA DATATABLES
     */
    public function data()
    {
        $satuans = MasterSatuanObat::query()
            ->select([
                'id',
                'kode',
                'nama',
            ]);

        return DataTables::of($satuans)
            ->addIndexColumn()

            ->addColumn('aksi', function ($satuan) {

                return '
                    <div class="aksi-wrapper">

                        <button
                            type="button"
                            class="btn btn-satuan-aksi btn-satuan-lihat"
                            title="Lihat"
                        >
                            <i class="fas fa-eye me-1"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-satuan-aksi btn-satuan-edit"
                            title="Edit"
                        >
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-satuan-aksi btn-satuan-hapus"
                            title="Hapus"
                        >
                            <i class="fas fa-trash me-1"></i>
                            Hapus
                        </button>

                    </div>
                ';
            })

            ->rawColumns(['aksi'])

            ->make(true);
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('master-satuan.create');
    }

    /**
     * TAMBAH DATA
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'kode' => [
                    'nullable',
                    'string',
                    'max:255'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

            $satuan = MasterSatuanObat::create([
                'kode' => $validated['kode'] ?? null,
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data satuan obat berhasil ditambahkan.',
                'data' => $satuan,
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
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * LIHAT DETAIL
     */
    public function show($id)
    {
        try {

            $satuan = MasterSatuanObat::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $satuan,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data satuan tidak ditemukan.',
            ], 404);
        }
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $satuan = MasterSatuanObat::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $satuan,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'kode' => [
                    'nullable',
                    'string',
                    'max:255'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

            $satuan = MasterSatuanObat::findOrFail($id);

            $satuan->update([
                'kode' => $validated['kode'] ?? null,
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data satuan obat berhasil diperbarui.',
                'data' => $satuan,
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
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        try {

            $satuan = MasterSatuanObat::findOrFail($id);

            $satuan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data satuan obat berhasil dihapus.',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == '23000') {

                return response()->json([
                    'success' => false,
                    'message' => 'Data satuan tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data satuan.',
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
