<?php

namespace App\Http\Controllers;

use App\Models\MasterKategori;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MasterKategoriController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER KATEGORI
     * =========================================================
     */
    public function index()
    {
        return view('master-kategori.index');
    }


    /**
     * =========================================================
     * DATA YAJRA DATATABLES
     * =========================================================
     */
    public function data()
    {
        $kategoris = MasterKategori::query()
            ->select([
                'id',
                'kode',
                'nama',
                'created_at',
                'updated_at'
            ]);

        return DataTables::of($kategoris)
            ->addIndexColumn()

            ->addColumn('aksi', function ($kategori) {

                $updateUrl = route(
                    'master-kategori.update',
                    $kategori->id
                );

                $deleteUrl = route(
                    'master-kategori.destroy',
                    $kategori->id
                );

                return '
                    <div class="aksi-wrapper">

                        <button
                            type="button"
                            class="btn-aksi-kategori btn-lihat-kategori"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn-aksi-kategori btn-edit-kategori"
                            data-url="' . $updateUrl . '"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn-aksi-kategori btn-hapus-kategori"
                            data-url="' . $deleteUrl . '"
                            title="Hapus"
                        >
                            <i class="fas fa-trash"></i>
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
        return view('master-kategori.create');
    }


    /**
     * =========================================================
     * SIMPAN KATEGORI
     * =========================================================
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'kode' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

            $kategori = MasterKategori::create([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data kategori berhasil ditambahkan.',
                'data' => $kategori
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * =========================================================
     * SHOW
     * =========================================================
     */
    public function show(string $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        return view(
            'master-kategori.show',
            compact('kategori')
        );
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(string $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        return view(
            'master-kategori.edit',
            compact('kategori')
        );
    }


    /**
     * =========================================================
     * UPDATE KATEGORI
     * =========================================================
     */
    public function update(
        Request $request,
        string $id
    ) {
        try {

            $validated = $request->validate([
                'kode' => [
                    'required',
                    'string',
                    'max:50'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

            $kategori = MasterKategori::findOrFail($id);

            $kategori->update([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data kategori berhasil diperbarui.'
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * =========================================================
     * HAPUS KATEGORI
     * =========================================================
     */
    public function destroy(string $id)
    {
        try {

            $kategori = MasterKategori::findOrFail($id);

            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data kategori berhasil dihapus.'
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == '23000') {

                return response()->json([
                    'success' => false,
                    'message' => 'Kategori tidak dapat dihapus karena masih digunakan pada data lain.'
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kategori dari database.'
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
