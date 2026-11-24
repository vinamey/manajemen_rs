<?php

namespace App\Http\Controllers;

use App\Models\MasterKamar;
use App\Models\PendaftaranPasien;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MasterKamarController extends Controller
{
    private const KAPASITAS_KAMAR = 4;

    private const STATUS_PASIEN_AKTIF = [
        'menunggu',
        'diperiksa',
    ];

    /*
    |--------------------------------------------------------------------------
    | HALAMAN MASTER KAMAR
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('master-kamar.index');
    }


    /*
    |--------------------------------------------------------------------------
    | MENENTUKAN STATUS KAMAR
    |--------------------------------------------------------------------------
    */
    private function hitungStatusKamar($jumlahPasien)
    {
        if ($jumlahPasien >= self::KAPASITAS_KAMAR) {
            return 'penuh';
        }

        return 'tersedia';
    }


    /*
    |--------------------------------------------------------------------------
    | MENGHITUNG PASIEN AKTIF DALAM KAMAR
    |--------------------------------------------------------------------------
    */
    private function hitungJumlahPasien($kamarId)
    {
        return PendaftaranPasien::where('kamar_id', $kamarId)
            ->whereIn('status', self::STATUS_PASIEN_AKTIF)
            ->distinct()
            ->count('pasien_id');
    }


    /*
    |--------------------------------------------------------------------------
    | DATA YAJRA DATATABLES
    |--------------------------------------------------------------------------
    */
    public function data()
    {
        $kamars = MasterKamar::query()
            ->select([
                'id',
                'nama',
            ])
            ->selectSub(
                PendaftaranPasien::query()
                    ->selectRaw('COUNT(DISTINCT pasien_id)')
                    ->whereColumn(
                        'pendaftaran_pasiens.kamar_id',
                        'master_kamars.id'
                    )
                    ->whereIn(
                        'status',
                        self::STATUS_PASIEN_AKTIF
                    ),
                'jumlah_pasien'
            )
            ->orderByDesc('id');

        return DataTables::of($kamars)

            ->addIndexColumn()

            // STATUS OTOMATIS
            ->addColumn('status', function ($kamar) {

                return $this->hitungStatusKamar(
                    (int) $kamar->jumlah_pasien
                );

            })

            // TOMBOL AKSI
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

            ->rawColumns(['aksi'])
            ->make(true);
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
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
                'nama.required' => 'Nama kamar wajib diisi.',
            ]);

            $kamar = MasterKamar::create([
                'nama' => $validated['nama'],
                'status' => 'tersedia',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data kamar berhasil ditambahkan!',
                'data' => $kamar,
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data kamar.',
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
        try {

            $kamar = MasterKamar::findOrFail($id);

            $jumlahPasien = $this->hitungJumlahPasien(
                $kamar->id
            );

            $kamar->setAttribute(
                'jumlah_pasien',
                $jumlahPasien
            );

            $kamar->setAttribute(
                'status',
                $this->hitungStatusKamar($jumlahPasien)
            );

            return response()->json([
                'success' => true,
                'data' => $kamar,
            ]);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Data kamar tidak ditemukan.',
            ], 404);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        try {

            $kamar = MasterKamar::findOrFail($id);

            $validated = $request->validate([
                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ], [
                'nama.required' => 'Nama kamar wajib diisi.',
            ]);

            // Hanya memperbarui nama kamar.
            // Status dihitung otomatis berdasarkan jumlah pasien.
            $kamar->update([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data kamar berhasil diperbarui!',
                'data' => $kamar,
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data kamar.',
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

            $kamar = MasterKamar::findOrFail($id);

            $kamar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data kamar berhasil dihapus!',
            ]);

        } catch (QueryException $e) {

            if ((string) $e->getCode() === '23000') {

                return response()->json([
                    'success' => false,
                    'message' => 'Data kamar tidak dapat dihapus karena masih digunakan pada data lain.',
                ], 422);
            }

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data kamar.',
            ], 500);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Data kamar tidak ditemukan atau gagal dihapus.',
            ], 404);
        }
    }
}
