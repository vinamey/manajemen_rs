<?php

namespace App\Http\Controllers;

use App\Models\MasterKamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MasterKamarController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER KAMAR
     * =========================================================
     */
    public function index()
    {
        return view('master-kamar.index');
    }


    /**
     * =========================================================
     * DATA YAJRA DATATABLES
     * =========================================================
     */
    public function data()
    {
        $kamars = MasterKamar::query()
            ->select([
                'id',
                'kode',
                'nama',
                'status',
            ])
            ->orderByDesc('id');

        return DataTables::of($kamars)

            ->addIndexColumn()

            ->addColumn('aksi', function ($kamar) {

                return '
                    <div class="aksi-wrapper">

                        <button
                            type="button"
                            class="btn btn-aksi-kamar btn-lihat-kamar"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                            Lihat
                        </button>

                        <button
                            type="button"
                            class="btn btn-aksi-kamar btn-edit-kamar"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>

                        <button
                            type="button"
                            class="btn btn-aksi-kamar btn-hapus-kamar"
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
     * SIMPAN DATA
     * =========================================================
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate(
                [
                    'kode' => [
                        'required',
                        'string',
                        Rule::unique('master_kamars', 'kode'),
                    ],

                    'nama' => [
                        'required',
                        'string',
                    ],

                    'status' => [
                        'required',
                        Rule::in([
                            'tersedia',
                            'terisi',
                        ]),
                    ],
                ],
                [
                    'kode.required' =>
                        'Kode Kamar wajib diisi.',

                    'kode.unique' =>
                        'Kode Kamar sudah digunakan.',

                    'nama.required' =>
                        'Nama Kamar wajib diisi.',

                    'status.required' =>
                        'Status kamar wajib dipilih.',

                    'status.in' =>
                        'Status kamar tidak valid.',
                ]
            );


            $kamar = MasterKamar::create([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
                'status' => $validated['status'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data kamar berhasil ditambahkan!',
                'data' => $kamar,
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
                    'Terjadi kesalahan saat menyimpan data kamar.',
            ], 500);
        }
    }


    /**
     * =========================================================
     * DETAIL DATA
     * =========================================================
     */
    public function show($id)
    {
        try {

            $kamar = MasterKamar::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $kamar,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data kamar tidak ditemukan.',
            ], 404);
        }
    }


    /**
     * =========================================================
     * UPDATE DATA
     * =========================================================
     */
    public function update(Request $request, $id)
    {
        try {

            $kamar = MasterKamar::findOrFail($id);


            $validated = $request->validate(
                [
                    'kode' => [
                        'required',
                        'string',

                        Rule::unique(
                            'master_kamars',
                            'kode'
                        )->ignore($kamar->id),
                    ],

                    'nama' => [
                        'required',
                        'string',
                    ],

                    'status' => [
                        'required',
                        Rule::in([
                            'tersedia',
                            'terisi',
                        ]),
                    ],
                ],
                [
                    'kode.required' =>
                        'Kode Kamar wajib diisi.',

                    'kode.unique' =>
                        'Kode Kamar sudah digunakan.',

                    'nama.required' =>
                        'Nama Kamar wajib diisi.',

                    'status.required' =>
                        'Status kamar wajib dipilih.',

                    'status.in' =>
                        'Status kamar tidak valid.',
                ]
            );


            $kamar->update([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
                'status' => $validated['status'],
            ]);


            return response()->json([
                'success' => true,
                'message' =>
                    'Data kamar berhasil diperbarui!',
                'data' => $kamar,
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
                    'Terjadi kesalahan saat memperbarui data kamar.',
            ], 500);
        }
    }


    /**
     * =========================================================
     * HAPUS DATA
     * =========================================================
     */
    public function destroy($id)
    {
        try {

            $kamar = MasterKamar::findOrFail($id);

            $kamar->delete();


            return response()->json([
                'success' => true,
                'message' =>
                    'Data kamar berhasil dihapus!',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == '23000') {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Data kamar tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }


            return response()->json([
                'success' => false,
                'message' =>
                    'Gagal menghapus data kamar.',
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Data kamar tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
