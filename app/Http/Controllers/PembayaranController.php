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
     * Membuat bukti transfer simulasi otomatis.
     */
    private function buatBuktiTransfer(
        Pembayaran $pembayaran,
        ResepObat $resep,
        string $bank
    ): string {
        $namaPasien = $resep->pemeriksaan
            ->pendaftaran
            ->pasien
            ->nama ?? '-';

        $nomorTransaksi = 'TRF-' .
            date('Ymd') .
            '-' .
            str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT);

        $tanggal = now()->format('d-m-Y H:i:s');

        $nominal = number_format(
            (float) $pembayaran->total_pembayaran,
            0,
            ',',
            '.'
        );

        // Amankan teks agar tidak merusak HTML
        $namaPasien = htmlspecialchars(
            $namaPasien,
            ENT_QUOTES,
            'UTF-8'
        );

        $bank = htmlspecialchars(
            $bank,
            ENT_QUOTES,
            'UTF-8'
        );

        $html = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bukti Transfer SIM RS</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f1f5f9;
        padding: 30px;
        color: #1e293b;
    }

    .receipt {
        max-width: 500px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,.08);
    }

    h2 {
        color: #1877f2;
        text-align: center;
        margin-bottom: 5px;
    }

    .subtitle {
        text-align: center;
        color: #64748b;
        margin-bottom: 25px;
    }

    .success {
        text-align: center;
        background: #e7f3ff;
        color: #1877f2;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .label {
        color: #64748b;
    }

    .value {
        text-align: right;
        font-weight: bold;
    }

    .total {
        font-size: 20px;
        color: #1877f2;
    }

    .note {
        background: #fff7ed;
        color: #9a3412;
        padding: 12px;
        border-radius: 8px;
        margin-top: 20px;
        font-size: 13px;
    }

    button {
        display: block;
        width: 100%;
        margin-top: 20px;
        border: none;
        padding: 12px;
        background: #1877f2;
        color: white;
        border-radius: 8px;
        cursor: pointer;
    }

    @media print {
        body {
            background: white;
            padding: 0;
        }

        .receipt {
            box-shadow: none;
        }

        button {
            display: none;
        }
    }
</style>
</head>

<body>

<div class="receipt">

    <h2>SIM RS</h2>
    <div class="subtitle">Bukti Transfer Digital</div>

    <div class="success">
        TRANSFER SIMULASI BERHASIL
    </div>

    <div class="row">
        <span class="label">Nomor Transaksi</span>
        <span class="value">{$nomorTransaksi}</span>
    </div>

    <div class="row">
        <span class="label">Nama Pasien</span>
        <span class="value">{$namaPasien}</span>
    </div>

    <div class="row">
        <span class="label">Metode</span>
        <span class="value">Transfer Bank</span>
    </div>

    <div class="row">
        <span class="label">Bank Tujuan</span>
        <span class="value">{$bank}</span>
    </div>

    <div class="row">
        <span class="label">Tanggal</span>
        <span class="value">{$tanggal}</span>
    </div>

    <div class="row">
        <span class="label">Total Pembayaran</span>
        <span class="value total">Rp {$nominal}</span>
    </div>

    <div class="row">
        <span class="label">Status</span>
        <span class="value">MENUNGGU VERIFIKASI</span>
    </div>

    <div class="note">
        Bukti ini merupakan transaksi simulasi dari aplikasi SIM RS
        dan bukan konfirmasi transaksi dari bank sungguhan.
    </div>

    <button onclick="window.print()">
        Cetak Bukti Transfer
    </button>

</div>

</body>
</html>
HTML;

        $namaFile = 'bukti-transfer-simulasi/' .
            $nomorTransaksi .
            '.html';

        Storage::disk('public')->put($namaFile, $html);

        return $namaFile;
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

            'bank_tujuan' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $idPembayaran = null;
        $pathBukti = null;

        try {
            DB::transaction(function () use (
                $data,
                $id,
                &$idPembayaran,
                &$pathBukti
            ) {
                $resep = ResepObat::with([
                    'pemeriksaan.pendaftaran.pasien',
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

                // Validasi Cash
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

                // Tentukan status awal
                if ($data['metode_pembayaran'] === 'Cash') {
                    $status = 'LUNAS';
                } else {
                    $status = 'MENUNGGU VERIFIKASI';
                }

                // Buat catatan pembayaran
                $pembayaran = Pembayaran::createa([
                    'resep_id' => $resep->id,
                    'total_pembayaran' => $totalPembayaran,
                    'metode_pembayaran' => $data['metode_pembayaran'],
                    'status' => $status,
                    'bukti_transfer' => null,
                ]);

                // Jika Transfer Bank, buat bukti otomatis
                if ($data['metode_pembayaran'] === 'Transfer Bank') {
                    $bank = $data['bank_tujuan'] ?? 'Bank tujuan';

                    $pathBukti = $this->buatBuktiTransfer(
                        $pembayaran,
                        $resep,
                        $bank
                    );

                    $pembayaran->update([
                        'bukti_transfer' => $pathBukti,
                        'status' => 'MENUNGGU VERIFIKASI',
                    ]);
                }

                $idPembayaran = $pembayaran->id;
            });
        } catch (Throwable $e) {
            // Bersihkan file jika proses pembayaran gagal
            if ($pathBukti) {
                Storage::disk('public')->delete($pathBukti);
            }

            throw $e;
        }

        // Pesan sesuai metode pembayaran
        if ($data['metode_pembayaran'] === 'Cash') {
            $pesan = 'Pembayaran tunai berhasil dicatat.';
        } elseif ($data['metode_pembayaran'] === 'QRIS') {
            $pesan = 'Pembayaran QRIS berhasil dicatat dan menunggu verifikasi.';
        } else {
            $pesan = 'Bukti transfer simulasi berhasil dibuat. Pembayaran menunggu verifikasi.';
        }

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', $pesan)
            ->with('bukti_transfer_id', $idPembayaran);
    }


    /**
     * Memverifikasi pembayaran QRIS atau Transfer Bank.
     *
     * Transfer Bank lama yang belum memiliki bukti otomatis
     * akan dibuatkan bukti simulasi sebelum diverifikasi.
     */
    public function verifikasi($id)
    {
        $pathBukti = null;

        try {
            $berhasil = DB::transaction(function () use (
                $id,
                &$pathBukti
            ) {
                $pembayaran = Pembayaran::with([
                    'resep.pemeriksaan.pendaftaran.pasien',
                ])
                    ->whereKey($id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Pastikan status masih menunggu verifikasi
                if (
                    $pembayaran->status !== 'MENUNGGU VERIFIKASI' ||
                    !in_array(
                        $pembayaran->metode_pembayaran,
                        ['QRIS', 'Transfer Bank']
                    )
                ) {
                    return false;
                }

                // Transfer Bank wajib memiliki bukti
                if (
                    $pembayaran->metode_pembayaran === 'Transfer Bank' &&
                    empty($pembayaran->bukti_transfer)
                ) {
                    $resep = $pembayaran->resep;

                    if (!$resep) {
                        return false;
                    }

                    // Buat bukti otomatis untuk data pembayaran lama
                    $pathBukti = $this->buatBuktiTransfer(
                        $pembayaran,
                        $resep,
                        'Bank tujuan (data lama)'
                    );

                    $pembayaran->bukti_transfer = $pathBukti;
                }

                // Ubah status menjadi LUNAS
                $pembayaran->status = 'LUNAS';
                $pembayaran->save();

                return true;
            });
        } catch (Throwable $e) {
            // Hapus bukti yang baru dibuat jika proses gagal
            if ($pathBukti) {
                Storage::disk('public')->delete($pathBukti);
            }

            throw $e;
        }

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
            ->with(
                'success',
                'Riwayat pembayaran berhasil dihapus.'
            );
    }
}
