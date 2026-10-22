<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\LogStokObat;
use Illuminate\Support\Facades\DB;

class LogStokObatController extends Controller
{
    public function index()
    {
        $obats = MasterObat::orderBy('nama', 'asc')->get();

        // Jika kolom status belum ada di database, kita pisahkan berdasarkan nilai (negatif untuk keluar, positif untuk masuk)
        // Atau jika Anda ingin menggunakan kolom lain, sesuaikan di sini.
        $logsLama = LogStokObat::with(['obat', 'stokObat'])
            ->where('nilai', '<=', 0)
            ->latest()
            ->get();
        $logsBaru = LogStokObat::with(['obat', 'stokObat'])
            ->where('nilai', '>', 0)
            ->latest()
            ->get();

        return view('log-stok-obat.index', compact('obats', 'logsLama', 'logsBaru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',
            'nilai' => 'required|integer|min:1',
            'satuan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Buat record atau update stok tersedia di tabel stok_obat
            $stokObat = StokObat::firstOrCreate(
                [
                    'obat_id' => $request->obat_id,
                ],
                [
                    'harga_jual' => 0,
                    'stok_tersedia' => 0,
                ],
            );

            $stokObat->increment('stok_tersedia', $request->nilai);

            // 2. Simpan ke log_stok_obat beserta tanggal kedaluwarsa
            LogStokObat::create([
                'obat_id' => $request->obat_id,
                'nilai' => $request->nilai,
                'stok_obat_id' => $stokObat->id,
                'status' => 'masuk',
                'tanggal_update' => now(),
            ]);
        });

        return redirect()->route('apoteker.log-stok-obat.index')->with('success', 'Stok obat berhasil ditambahkan.');
    }
}
