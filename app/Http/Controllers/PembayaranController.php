<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $queryResep = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat.hargaJual',
        ])->whereDoesntHave('pembayaran');

        if ($request->filled('search')) {
            $search = $request->search;

            $queryResep->whereHas(
                'pemeriksaan.pendaftaran.pasien',
                fn ($query) => $query->where('nama', 'like', "%{$search}%")
            );
        }

        if ($request->filled('tanggal_mulai')) {
            $queryResep->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $queryResep->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        $resepObats = $queryResep
            ->latest()
            ->paginate(10, ['*'], 'resepPage')
            ->withQueryString();

        $riwayatPembayaran = Pembayaran::with([
            'resep.pemeriksaan.pendaftaran.pasien',
            'resep.pemeriksaan.dokter',
            'resep.obat.hargaJual',
        ])->latest()
            ->paginate(10, ['*'], 'riwayatPage')
            ->withQueryString();

        return view('kasir.pembayaran', compact(
            'resepObats',
            'riwayatPembayaran'
        ));
    }

    /**
     * Menghitung total harga obat dalam resep.
     * Harga per satuan resep = harga jual / isi.
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
            $hargaJual = $obat->hargaJual->first();

            if (!$hargaJual || (int) $hargaJual->isi <= 0) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Harga jual atau isi obat ' . $obat->nama . ' belum valid.',
                ]);
            }

            $jumlah = (int) ($obat->pivot->nilai ?? 0);

            if ($jumlah <= 0) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Jumlah obat ' . $obat->nama . ' tidak valid.',
                ]);
            }

            $hargaPerSatuan = (float) $hargaJual->harga
                / (int) $hargaJual->isi;

            $total += $hargaPerSatuan * $jumlah;
        }

        if ($total <= 0) {
            throw ValidationException::withMessages([
                'pembayaran' => 'Total pembayaran tidak valid.',
            ]);
        }

        return $total;
    }

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
            $resep = ResepObat::with('obat.hargaJual')
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            $sudahAda = Pembayaran::where('resep_id', $resep->id)
                ->lockForUpdate()
                ->exists();

            if ($sudahAda) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Resep ini sudah memiliki catatan pembayaran.',
                ]);
            }

            $totalPembayaran = $this->hitungTotal($resep);

            if ($data['metode_pembayaran'] === 'Cash') {
                if (!isset($data['uang_diterima']) || $data['uang_diterima'] === '') {
                    throw ValidationException::withMessages([
                        'uang_diterima' => 'Masukkan jumlah uang yang diterima.',
                    ]);
                }

                if ((float) $data['uang_diterima'] < $totalPembayaran) {
                    throw ValidationException::withMessages([
                        'uang_diterima' => 'Uang yang diterima kurang dari total pembayaran.',
                    ]);
                }
            }

            $status = $data['metode_pembayaran'] === 'Cash'
                ? 'LUNAS'
                : 'MENUNGGU VERIFIKASI';

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

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', 'Riwayat pembayaran berhasil dihapus.');
    }
}
