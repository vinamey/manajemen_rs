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
     * Menampilkan daftar resep dan riwayat pembayaran.
     */
    public function index()
    {
        // Menampilkan resep yang belum memiliki transaksi pembayaran.
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
            ->whereDoesntHave('pembayaran')
            ->latest()
            ->paginate(10, ['*'], 'resepPage');

        // Menampilkan seluruh riwayat pembayaran.
        $riwayatPembayaran = Pembayaran::with([
            'resep.pemeriksaan.pendaftaran.pasien',
            'resep.pemeriksaan.dokter',
        ])
            ->latest()
            ->paginate(10, ['*'], 'riwayatPage');

        return view('kasir.pembayaran', compact(
            'resepObats',
            'riwayatPembayaran'
        ));
    }

    /**
     * Memproses pembayaran resep.
     */
    public function proses(Request $request, $id)
    {
        $data = $request->validate([
            'total_pembayaran' => [
                'required',
                'numeric',
                'min:1',
            ],
            'metode_pembayaran' => [
                'required',
                'in:QRIS,Cash,Transfer Bank',
            ],
            'uang_diterima' => [
                'required_if:metode_pembayaran,Cash',
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        // Validasi uang tunai harus mencukupi total pembayaran.
        if (
            $data['metode_pembayaran'] === 'Cash' &&
            (float) $data['uang_diterima'] < (float) $data['total_pembayaran']
        ) {
            throw ValidationException::withMessages([
                'uang_diterima' => 'Uang yang diterima masih kurang dari total pembayaran.',
            ]);
        }

        $resep = ResepObat::with('obat')->findOrFail($id);

        if ($resep->obat->isEmpty()) {
            return redirect()
                ->route('kasir.pembayaran')
                ->with('error', 'Resep ini belum memiliki obat.');
        }

        DB::transaction(function () use ($resep, $data) {
            // Mencegah transaksi ganda untuk resep yang sama.
            $sudahAda = Pembayaran::where('resep_id', $resep->id)
                ->lockForUpdate()
                ->exists();

            if ($sudahAda) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Resep ini sudah memiliki catatan pembayaran.',
                ]);
            }

            // Cash dicatat lunas; QRIS dan transfer menunggu verifikasi.
            $status = $data['metode_pembayaran'] === 'Cash'
                ? 'LUNAS'
                : 'MENUNGGU VERIFIKASI';

            Pembayaran::create([
                'resep_id' => $resep->id,
                'total_pembayaran' => $data['total_pembayaran'],
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
     * Menghapus catatan pembayaran.
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

