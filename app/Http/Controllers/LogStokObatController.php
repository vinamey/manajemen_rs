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
    // 1. Cek apakah tabel satuan_obats kosong, jika kosong otomatis isi data defaultnya
    if (DB::table('master_satuan_obats')->count() == 0) {
        DB::table('master_satuan_obats')->insert([
            ['nama' => 'Strip', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Box', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tablet', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Botol', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sirup', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    // 2. Ambil data log stok beserta relasinya
    $logStokObats = LogStokObat::with(['obat', 'stokObat'])->latest()->get();
    
    // 3. Ambil data master obat untuk dropdown
    $obats = MasterObat::orderBy('nama', 'asc')->get(); 

    // 4. Ambil data satuan obat untuk pilihan di modal
    $satuans = DB::table('master_satuan_obats')->get(); 

    return view('log-stok-obat.index', compact('logStokObats', 'obats', 'satuans'));
}

    public function store(Request $request)
    {
        // Validasi input dari modal pop-up
        $request->validate([
            'obat_id' => 'required|integer|exists:master_obats,id',
            'satuan_obat_id' => 'required|integer', 
            'nilai' => 'required|integer|min:1',
            'expired_date' => 'nullable|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Simpan atau perbarui ke tabel stok_obats beserta satuan_obat_id
                $stokObat = StokObat::updateOrCreate(
                    ['obat_id' => $request->obat_id],
                    [
                        'satuan_obat_id' => $request->satuan_obat_id,
                        'stok_tersedia' => (int) $request->nilai,
                    ]
                );

                // Simpan riwayat ke tabel log_stok_obat dengan tanggal dan jam lengkap (now())
                $dataLog = [
                    'obat_id' => $request->obat_id,
                    'stok_obat_id' => $stokObat->id,
                    'nilai' => (int) $request->nilai,
                    'tanggal_update' => now(),
                ];

                if (Schema::hasColumn('log_stok_obat', 'status')) {
                    $dataLog['status'] = 'masuk';
                }

                if ($request->filled('expired_date') && Schema::hasColumn('log_stok_obat', 'expired_date')) {
                    $dataLog['expired_date'] = $request->expired_date;
                }

                if ($request->filled('keterangan') && Schema::hasColumn('log_stok_obat', 'keterangan')) {
                    $dataLog['keterangan'] = $request->keterangan;
                }

                LogStokObat::create($dataLog);
            });

            return redirect()->back()->with('success', 'Stok obat berhasil diperbarui.');

        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan stok obat.');
        }
    }
}