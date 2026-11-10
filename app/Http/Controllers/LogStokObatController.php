<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\LogStokObat;
use App\Models\HargaJualObat;
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

                // Cari stok berdasarkan obat dan satuan
                $stokObat = StokObat::where('obat_id', $request->obat_id)
                    ->where('satuan_obat_id', $request->satuan_obat_id)
                    ->lockForUpdate()
                    ->first();

                // Jika stok belum ada atau harganya masih 0,
                // ambil harga dari tabel harga_jual_obats.
                if (!$stokObat || (float) $stokObat->harga_jual <= 0) {

                    $hargaJual = HargaJualObat::where('obat_id', $request->obat_id)
                        ->where('satuan_id', $request->satuan_obat_id)
                        ->first();

                    // Jangan simpan stok jika harga belum diatur Admin
                    if (!$hargaJual || (float) $hargaJual->harga <= 0) {
                        throw new \RuntimeException(
                            'Harga jual obat dan satuan ini belum diatur Admin di tabel harga_jual_obats.'
                        );
                    }

                    $harga = (int) round((float) $hargaJual->harga);

                    // Buat stok baru dengan harga dari tabel harga jual
                    if (!$stokObat) {
                        $stokObat = StokObat::create([
                            'obat_id' => $request->obat_id,
                            'satuan_obat_id' => $request->satuan_obat_id,
                            'harga_jual' => $harga,
                            'stok_tersedia' => 0,
                        ]);
                    } else {
                        // Perbaiki harga stok lama yang masih 0
                        $stokObat->harga_jual = $harga;
                        $stokObat->save();
                    }
                }

                // Tambahkan jumlah stok masuk
                $stokObat->stok_tersedia += (int) $request->nilai;
                $stokObat->save();

                // Simpan riwayat stok masuk
                $dataLog = [
                    'obat_id' => $stokObat->obat_id,
                    'stok_obat_id' => $stokObat->id,
                    'nilai' => (int) $request->nilai,
                    'tanggal_update' => now(),
                ];

                if (Schema::hasColumn('log_stok_obats', 'status')) {
                    $dataLog['status'] = 'masuk';
                }

                if (
                    $request->filled('expired_date') &&
                    Schema::hasColumn('log_stok_obats', 'expired_date')
                ) {
                    $dataLog['expired_date'] = $request->expired_date;
                }

                if (
                    $request->filled('keterangan') &&
                    Schema::hasColumn('log_stok_obats', 'keterangan')
                ) {
                    $dataLog['keterangan'] = $request->keterangan;
                }

                LogStokObat::create($dataLog);
            });

            return redirect()->back()->with(
                'success',
                'Stok obat berhasil ditambahkan.'
            );

        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    $e instanceof \RuntimeException
                        ? $e->getMessage()
                        : 'Gagal menyimpan stok obat. Periksa log Laravel untuk detail kesalahan.'
                );
        }
    }
}
