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

    $stokObats = StokObat::with(['obat', 'satuanObat'])->get();

    $logStokObats = LogStokObat::with(['obat', 'stokObat'])
        ->latest()
        ->get();

    $satuans = DB::table('master_satuan_obats')->get();

    return view('log-stok-obat.index', compact(
        'obats',
        'stokObats',
        'logStokObats',
        'satuans'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|integer|exists:master_obats,id',
            'satuan_obat_id' => 'required|integer|exists:master_satuan_obats,id',
            'nilai' => 'required|integer|min:1',
            'expired_date' => 'nullable|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            DB::transaction(function () use ($request) {

                // Simpan stok aktif untuk obat yang dipilih.
                $stokObat = StokObat::updateOrCreate(
                    ['obat_id' => $request->obat_id],
                    [
                        'satuan_obat_id' => $request->satuan_obat_id,
                        'stok_tersedia' => (int) $request->nilai,
                    ]
                );

                // Simpan riwayat stok.
                $dataLog = [
                    'obat_id' => $request->obat_id,
                    'stok_obat_id' => $stokObat->id,
                    'nilai' => (int) $request->nilai,
                    'tanggal_update' => now(),
                ];

                // Gunakan nama tabel yang benar.
                $table = 'log_stok_obats';

                if (Schema::hasColumn($table, 'status')) {
                    $dataLog['status'] = 'masuk';
                }

                if (
                    $request->filled('expired_date') &&
                    Schema::hasColumn($table, 'expired_date')
                ) {
                    $dataLog['expired_date'] = $request->expired_date;
                }

                if (
                    $request->filled('keterangan') &&
                    Schema::hasColumn($table, 'keterangan')
                ) {
                    $dataLog['keterangan'] = $request->keterangan;
                }

                LogStokObat::create($dataLog);
            });

            return redirect()->back()->with(
                'success',
                'Stok obat berhasil diperbarui.'
            );

        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan stok obat. Periksa log Laravel untuk detail kesalahan.');
        }
    }
}
