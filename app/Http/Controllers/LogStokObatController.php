<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\LogStokObat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LogStokObatController extends Controller
{
    public function index()
    {
        $obats = MasterObat::orderBy('nama', 'asc')->get();

        $logsLama = LogStokObat::with(['obat', 'stokObat'])
            ->where('nilai', '<=', 0)
            ->latest('tanggal_update')
            ->get();

        $logsBaru = LogStokObat::with(['obat', 'stokObat'])
            ->where('nilai', '>', 0)
            ->latest('tanggal_update')
            ->get();

        return view('log-stok-obat.index', compact(
            'obats',
            'logsLama',
            'logsBaru'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|integer|exists:master_obats,id',
            'nilai' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:100',
            'expired_date' => 'nullable|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $stokObat = StokObat::where('obat_id', $request->obat_id)
                    ->lockForUpdate()
                    ->first();

                if (!$stokObat) {
                    $dataStok = [
                        'obat_id' => $request->obat_id,
                        'harga_jual' => 0,
                        'stok_tersedia' => 0,
                    ];

                    $stokObat = StokObat::create($dataStok);
                }

                $stokObat->increment(
                    'stok_tersedia',
                    (int) $request->nilai
                );

                $dataLog = [
                    'obat_id' => $request->obat_id,
                    'stok_obat_id' => $stokObat->id,
                    'nilai' => (int) $request->nilai,
                    'tanggal_update' => now(),
                ];

                // Isi kolom tambahan hanya jika tersedia di tabel.
                if (Schema::hasColumn('log_stok_obat', 'status')) {
                    $dataLog['status'] = 'masuk';
                }

                if (
                    $request->filled('expired_date') &&
                    Schema::hasColumn('log_stok_obat', 'expired_date')
                ) {
                    $dataLog['expired_date'] = $request->expired_date;
                }

                if (
                    $request->filled('keterangan') &&
                    Schema::hasColumn('log_stok_obat', 'keterangan')
                ) {
                    $dataLog['keterangan'] = $request->keterangan;
                }

                LogStokObat::create($dataLog);
            });

            return redirect()
                ->back()
                ->with('success', 'Stok obat berhasil ditambahkan.');

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Stok gagal ditambahkan. Periksa struktur tabel dan log error Laravel.');
        }
    }
}