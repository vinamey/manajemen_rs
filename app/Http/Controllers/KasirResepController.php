<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\StokObat;
use App\Models\LogStokObat;
use Illuminate\Support\Facades\DB;
use Throwable;

class KasirResepController extends Controller
{
    /**
     * Halaman resep untuk Kasir.
     * Kasir hanya melihat resep yang sudah diproses.
     */
    public function index()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'detailResep.obat',
            'detailResep.satuan',
        ])
            ->where('status', 'diproses')
            ->latest()
            ->paginate(10);

        return view('kasir.resep', compact('resepObats'));
    }

    /**
     * Halaman resep untuk Apoteker.
     * Apoteker hanya melihat resep yang menunggu.
     */
    public function indexApoteker()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'detailResep.obat',
            'detailResep.satuan',
        ])
            ->where('status', 'menunggu')
            ->latest()
            ->paginate(10);

        return view('apoteker.resep', compact('resepObats'));
    }

    /**
     * Proses resep oleh Apoteker.
     */
    public function prosesApoteker($id)
    {
        try {
            DB::transaction(function () use ($id) {

                // Kunci data resep agar tidak diproses dua kali.
                $resep = ResepObat::where('id', $id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Pastikan resep masih menunggu.
                if ($resep->status !== 'menunggu') {
                    throw new \Exception(
                        'Resep ini sudah pernah diproses.'
                    );
                }

                // Ambil detail obat dari resep.
                $details = $resep->detailResep()->get();

                if ($details->isEmpty()) {
                    throw new \Exception(
                        'Resep tidak memiliki detail obat.'
                    );
                }

                // Periksa dan kurangi stok setiap obat.
                foreach ($details as $detail) {

                    if (
                        !$detail->obat_id ||
                        !$detail->satuan_obat_id ||
                        !$detail->nilai ||
                        $detail->nilai <= 0
                    ) {
                        throw new \Exception(
                            'Data obat, satuan, atau jumlah resep tidak valid.'
                        );
                    }

                    // Cari stok berdasarkan obat dan satuan.
                    $stok = StokObat::where(
                        'obat_id',
                        $detail->obat_id
                    )
                        ->where(
                            'satuan_obat_id',
                            $detail->satuan_obat_id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (!$stok) {
                        throw new \Exception(
                            'Stok obat tidak ditemukan atau satuannya berbeda. Obat ID: '
                            . $detail->obat_id
                        );
                    }

                    // Pastikan stok mencukupi.
                    if ($stok->stok_tersedia < $detail->nilai) {
                        throw new \Exception(
                            'Stok obat tidak mencukupi. Obat ID: '
                            . $detail->obat_id
                            . '. Stok tersedia: '
                            . $stok->stok_tersedia
                        );
                    }

                    // Kurangi stok.
                    $stok->stok_tersedia =
                        $stok->stok_tersedia - $detail->nilai;

                    $stok->save();

                    // Catat pengeluaran stok.
                    LogStokObat::create([
                        'obat_id' => $detail->obat_id,
                        'stok_obat_id' => $stok->id,
                        'nilai' => $detail->nilai,
                        'status' => 'keluar',
                        'tanggal_update' => now(),
                        'pivot_resep_obat_id' => $detail->id,
                    ]);
                }

                // Ubah status setelah seluruh obat berhasil diproses.
                $resep->status = 'diproses';
                $resep->save();
            });

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Resep berhasil diproses. Stok obat telah diperbarui.'
                );

        } catch (Throwable $e) {

            report($e);

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
