<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    /**
     * Menampilkan resep yang belum dibayar dan riwayat pembayaran.
     */
    public function index(Request $request)
    {
        // Resep yang belum memiliki pembayaran
        $queryResep = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat.hargaJual.satuan',
        ])->whereDoesntHave('pembayaran');

        // Pencarian berdasarkan nama pasien
        if ($request->filled('search')) {
            $search = $request->search;

            $queryResep->whereHas(
                'pemeriksaan.pendaftaran.pasien',
                function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                }
            );
        }

        // Filter tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $queryResep->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter tanggal selesai
        if ($request->filled('tanggal_selesai')) {
            $queryResep->whereDate(
                'created_at',
                '<=',
                $request->tanggal_selesai
            );
        }

        $resepObats = $queryResep
            ->latest()
            ->paginate(10, ['*'], 'resepPage')
            ->withQueryString();

        // Riwayat pembayaran
        $riwayatPembayaran = Pembayaran::with([
            'resep.pemeriksaan.pendaftaran.pasien',
            'resep.pemeriksaan.dokter',
            'resep.obat.hargaJual.satuan',
        ])
            ->latest()
            ->paginate(10, ['*'], 'riwayatPage')
            ->withQueryString();

        return view('kasir.pembayaran', compact(
            'resepObats',
            'riwayatPembayaran'
        ));
    }

    /**
     * Menghitung total harga obat berdasarkan satuan resep.
     *
     * Contoh:
     * Harga 1 strip = Rp10.000
     * Isi 1 strip = 10 tablet
     * Jumlah resep = 2 tablet
     * Total = Rp2.000
     */
    private function hitungTotal(ResepObat $resep): float
    {
        if ($resep->obat->isEmpty()) {
            throw ValidationException::withMessages([
                'pembayaran' => 'Resep ini belum memiliki detail obat.',
            ]);
        }

        $total = 0;

        foreach ($resep->obat as $obat) {

            // Ambil ID satuan dari detail resep
            $satuanResep = (int) $obat->pivot->satuan_obat_id;

            // Cari harga jual yang satuannya sesuai dengan resep
            $hargaJual = $obat->hargaJual->firstWhere(
                'satuan_id',
                $satuanResep
            );

            if (!$hargaJual) {
                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Harga jual untuk satuan obat ' .
                        $obat->nama .
                        ' belum tersedia.',
                ]);
            }

            $isi = (float) $hargaJual->isi;
            $harga = (float) $hargaJual->harga;
            $jumlah = (float) $obat->pivot->nilai;

            if ($isi <= 0 || $harga <= 0 || $jumlah <= 0) {
                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Harga, isi, atau jumlah obat ' .
                        $obat->nama .
                        ' tidak valid.',
                ]);
            }

            // Harga per satuan terkecil
            $hargaPerSatuan = $harga / $isi;

            // Total harga obat
            $subtotal = $hargaPerSatuan * $jumlah;

            $total += $subtotal;
        }

        $total = round($total, 2);

        if ($total <= 0) {
            throw ValidationException::withMessages([
                'pembayaran' => 'Total pembayaran tidak valid.',
            ]);
        }

        return $total;
    }

    /**
     * Memproses pembayaran resep.
     */
    public function proses(Request $request, $id)
    {
        $data = $request->validate([
            'metode_pembayaran' => [
                'required',
                'in:Cash,QRIS,Transfer Bank',
            ],

            'uang_diterima' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        DB::transaction(function () use ($data, $id) {

            // Ambil resep dan kunci selama transaksi
            $resep = ResepObat::with([
                'obat.hargaJual',
            ])
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            // Cegah pembayaran ganda
            $sudahAda = Pembayaran::where(
                'resep_id',
                $resep->id
            )
                ->lockForUpdate()
                ->exists();

            if ($sudahAda) {
                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Resep ini sudah memiliki catatan pembayaran.',
                ]);
            }

            // Hitung total harga resep
            $totalPembayaran = $this->hitungTotal($resep);

            // Validasi pembayaran tunai
            if ($data['metode_pembayaran'] === 'Cash') {

                if (
                    !isset($data['uang_diterima']) ||
                    $data['uang_diterima'] === ''
                ) {
                    throw ValidationException::withMessages([
                        'uang_diterima' =>
                            'Masukkan jumlah uang yang diterima.',
                    ]);
                }

                if (
                    (float) $data['uang_diterima']
                    < $totalPembayaran
                ) {
                    throw ValidationException::withMessages([
                        'uang_diterima' =>
                            'Uang yang diterima kurang dari total pembayaran.',
                    ]);
                }
            }

            // Tentukan status pembayaran
            $status = $data['metode_pembayaran'] === 'Cash'
                ? 'LUNAS'
                : 'MENUNGGU VERIFIKASI';

            // Simpan pembayaran
            Pembayaran::create([
                'resep_id' => $resep->id,
                'total_pembayaran' => $totalPembayaran,
                'metode_pembayaran' => $data['metode_pembayaran'],
                'status' => $status,
            ]);
        });

        $pesan = $data['metode_pembayaran'] === 'Cash'
            ? 'Pembayaran tunai berhasil dicatat.'
            : 'Pembayaran berhasil dicatat dan menunggu verifikasi.';

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', $pesan);
    }

    /**
     * Menghapus riwayat pembayaran.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->delete();

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', 'Riwayat pembayaran berhasil dihapus.');
    }
}
