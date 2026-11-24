<?php

namespace App\Http\Controllers;

use App\Models\MasterPoli;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MasterPoliController extends Controller
{
    /**
     * HALAMAN MASTER POLI
     */
    public function index()
    {
        return view('master-poli.index');
    }

    /**
     * DATA YAJRA DATATABLES
     */
    public function data()
    {
        $polis = MasterPoli::query()
            ->select([
                'id',
                'nama',
            ])
            ->orderByDesc('id');

        return DataTables::of($polis)
            ->addIndexColumn()

            ->addColumn('aksi', function ($poli) {
                return '
                    <div class="aksi-wrapper">

                        <button
                            type="button"
                            class="btn btn-poli-aksi btn-poli-lihat"
                            title="Lihat"
                        >
                            <i class="fas fa-eye me-1"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-poli-aksi btn-poli-edit"
                            title="Edit"
                        >
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-poli-aksi btn-poli-hapus"
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
     * FORM CREATE
     */
    public function create()
    {
        return view('master-poli.create');
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ], [
                'nama.required' => 'Nama Poli wajib diisi.',
            ]);

            // Membuat kode otomatis di belakang layar
            $nomor = 1;

            do {
                $kode = 'POL' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

                $sudahAda = MasterPoli::where('kode', $kode)->exists();

                $nomor++;

            } while ($sudahAda);

            $poli = MasterPoli::create([
                'kode' => $kode,
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data poli berhasil ditambahkan.',
                'data' => [
                    'id' => $poli->id,
                    'nama' => $poli->nama,
                ],
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
                'message' => 'Terjadi kesalahan saat menyimpan data poli.',
            ], 500);
        }
    }

    /**
     * DETAIL DATA
     */
    public function show($id)
    {
        try {
            $poli = MasterPoli::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $poli,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data poli tidak ditemukan.',
            ], 404);
        }
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        try {
            $poli = MasterPoli::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $poli,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data poli tidak ditemukan.',
            ], 404);
        }
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ], [
                'nama.required' => 'Nama Poli wajib diisi.',
            ]);

            $poli = MasterPoli::findOrFail($id);

            // Hanya memperbarui nama.
            // Kode lama tetap dipertahankan.
            $poli->update([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data poli berhasil diperbarui.',
                'data' => [
                    'id' => $poli->id,
                    'nama' => $poli->nama,
                ],
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
                'message' => 'Terjadi kesalahan saat memperbarui data poli.',
            ], 500);
        }
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        try {
            $poli = MasterPoli::findOrFail($id);

            $poli->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data poli berhasil dihapus.',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'Data poli tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data poli.',
            ], 500);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data poli tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
