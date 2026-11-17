<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class PembayaranController extends Controller
{
    /**
     * Menampilkan resep yang belum dibayar dan riwayat pembayaran.
     */
    public function index(Request $request)
    {
        $queryResep = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat.hargaJual.satuan',
        ])->whereDoesntHave('pembayaran');

        // Pencarian nama pasien
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
            $satuanResep = (int) $obat->pivot->satuan_obat_id;

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

            $hargaPerSatuan = $harga / $isi;
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

            'bukti_transfer' => [
                'required_if:metode_pembayaran,Transfer Bank',
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ], [
            'bukti_transfer.required_if' =>
                'Silakan unggah bukti transfer terlebih dahulu.',

            'bukti_transfer.file' =>
                'Bukti transfer harus berupa file.',

            'bukti_transfer.mimes' =>
                'Bukti transfer harus berformat JPG, JPEG, PNG, atau PDF.',

            'bukti_transfer.max' =>
                'Ukuran bukti transfer maksimal 2 MB.',
        ]);

        $pathBukti = null;

        try {
            DB::transaction(function () use (
                $data,
                $request,
                $id,
                &$pathBukti
            ) {
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

                $totalPembayaran = $this->hitungTotal($resep);

                // Validasi khusus pembayaran Cash
                if ($data['metode_pembayaran'] === 'Cash') {
                    $uangDiterima = $data['uang_diterima'] ?? null;

                    if ($uangDiterima === null || $uangDiterima === '') {
                        throw ValidationException::withMessages([
                            'uang_diterima' =>
                                'Masukkan jumlah uang yang diterima.',
                        ]);
                    }

                    if ((float) $uangDiterima < $totalPembayaran) {
                        throw ValidationException::withMessages([
                            'uang_diterima' =>
                                'Uang yang diterima kurang dari total pembayaran.',
                        ]);
                    }
                }

                // Simpan bukti transfer jika metode Transfer Bank
                if (
                    $data['metode_pembayaran'] === 'Transfer Bank' &&
                    $request->hasFile('bukti_transfer')
                ) {
                    $pathBukti = $request->file('bukti_transfer')
                        ->store('bukti-transfer', 'public');
                }

                // Tentukan status pembayaran
                $status = $data['metode_pembayaran'] === 'Cash'
                    ? 'LUNAS'
                    : 'MENUNGGU VERIFIKASI';

                Pembayaran::create([
                    'resep_id' => $resep->id,
                    'total_pembayaran' => $totalPembayaran,
                    'metode_pembayaran' => $data['metode_pembayaran'],
                    'status' => $status,
                    'bukti_transfer' => $pathBukti,
                ]);
            });
        } catch (Throwable $e) {
            // Hapus file jika transaksi database gagal
            if ($pathBukti) {
                Storage::disk('public')->delete($pathBukti);
            }

            throw $e;
        }

        $pesan = $data['metode_pembayaran'] === 'Cash'
            ? 'Pembayaran tunai berhasil dicatat.'
            : 'Pembayaran berhasil dicatat dan menunggu verifikasi.';

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', $pesan);
    }

    /**
     * Memverifikasi pembayaran QRIS atau Transfer Bank.
     */
    public function verifikasi($id)
    {
        $berhasil = DB::transaction(function () use ($id) {
            $pembayaran = Pembayaran::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $pembayaran->status !== 'MENUNGGU VERIFIKASI' ||
                !in_array(
                    $pembayaran->metode_pembayaran,
                    ['QRIS', 'Transfer Bank']
                )
            ) {
                return false;
            }

            $pembayaran->update([
                'status' => 'LUNAS',
            ]);

            return true;
        });

        if (!$berhasil) {
            return redirect()
                ->route('kasir.pembayaran')
                ->with(
                    'error',
                    'Pembayaran sudah diverifikasi atau tidak dapat diproses.'
                );
        }

        return redirect()
            ->route('kasir.pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil diverifikasi dan berstatus LUNAS.'
            );
    }

    /**
     * Menghapus riwayat pembayaran.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete(
                $pembayaran->bukti_transfer
            );
        }

        $pembayaran->delete();

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', 'Riwayat pembayaran berhasil dihapus.');
    }
}
