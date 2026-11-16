<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\LogStokObat;
use App\Models\HargaJualObat;

class LogStokObatController extends Controller
{
    public function index()
    {
        $obats = MasterObat::orderBy('nama', 'asc')->get();

        $satuans = DB::table('master_satuan_obats')
            ->orderBy('id')
            ->get();

        $stokObats = StokObat::with(['obat', 'satuanObat'])
            ->latest()
            ->get();

        $logStokObats = LogStokObat::with([
            'obat',
            'stokObat.satuanObat'
        ])->latest()->get();

        return view('log-stok-obat.index', compact(
            'obats',
            'satuans',
            'stokObats',
            'logStokObats'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obat_id' => [
                'required',
                'integer',
                'exists:master_obats,id'
            ],
            'satuan_obat_id' => [
                'required',
                'integer',
                'exists:master_satuan_obats,id'
            ],
            'nilai' => 'required|integer|min:1',
            'expired_date' => 'nullable|date',
        ], [
            'obat_id.required' => 'Nama obat wajib dipilih.',
            'obat_id.exists' => 'Obat yang dipilih tidak ditemukan.',
            'satuan_obat_id.required' => 'Satuan obat wajib dipilih.',
            'satuan_obat_id.exists' => 'Satuan obat tidak ditemukan.',
            'nilai.required' => 'Jumlah stok wajib diisi.',
            'nilai.integer' => 'Jumlah stok harus berupa angka.',
            'nilai.min' => 'Jumlah stok minimal 1.',
        ]);

        try {
            DB::transaction(function () use ($validated) {

                // Cari stok berdasarkan obat dan satuannya
                $stokObat = StokObat::where(
                    'obat_id',
                    $validated['obat_id']
                )->where(
                    'satuan_obat_id',
                    $validated['satuan_obat_id']
                )->lockForUpdate()->first();

                // Ambil harga jual jika stok belum ada
                // atau harga jual stok masih kosong
                if (!$stokObat || (float) $stokObat->harga_jual <= 0) {

                    $hargaJual = HargaJualObat::where(
                        'obat_id',
                        $validated['obat_id']
                    )->where(
                        'satuan_id',
                        $validated['satuan_obat_id']
                    )->first();

                    if (!$hargaJual || (float) $hargaJual->harga <= 0) {
                        throw new \RuntimeException(
                            'Harga jual obat untuk satuan ini belum tersedia di tabel harga_jual_obats.'
                        );
                    }

                    $harga = (int) round($hargaJual->harga);

                    if (!$stokObat) {
                        $stokObat = StokObat::create([
                            'obat_id' => $validated['obat_id'],
                            'satuan_obat_id' => $validated['satuan_obat_id'],
                            'harga_jual' => $harga,
                            'stok_tersedia' => 0,
                        ]);
                    } else {
                        $stokObat->harga_jual = $harga;
                        $stokObat->save();
                    }
                }

                // Tambahkan jumlah stok
                $stokObat->stok_tersedia =
                    (int) $stokObat->stok_tersedia
                    + (int) $validated['nilai'];

                $stokObat->save();

                // Siapkan data riwayat stok
                $dataLog = [
                    'obat_id' => $stokObat->obat_id,
                    'stok_obat_id' => $stokObat->id,
                    'nilai' => (int) $validated['nilai'],
                    'tanggal_update' => now()->toDateString(),
                ];

                // Tambahkan status jika kolomnya tersedia
                if (Schema::hasColumn('log_stok_obats', 'status')) {
                    $dataLog['status'] = 'masuk';
                }

                // Tambahkan tanggal kedaluwarsa jika kolom tersedia
                if (
                    !empty($validated['expired_date']) &&
                    Schema::hasColumn('log_stok_obats', 'expired_date')
                ) {
                    $dataLog['expired_date'] = $validated['expired_date'];
                }

                // Simpan riwayat log
                LogStokObat::create($dataLog);
            });

            return redirect()
                ->route('log-stok-obat.index')
                ->with('success', 'Stok obat berhasil ditambahkan.');

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
