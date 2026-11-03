<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use App\Models\LogStokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokObatController extends Controller
{
    public function storeStok(Request $request)
    {
        $validated = $request->validate([
            'obat_id' => 'required|exists:master_obats,id',
            'satuan_obat_id' => 'required|exists:master_satuan_obats,id',
            'jumlah' => 'required|integer|min:1',
        ], [
            'obat_id.required' => 'Nama obat wajib dipilih.',
            'obat_id.exists' => 'Data obat tidak ditemukan.',
            'satuan_obat_id.required' => 'Satuan obat wajib dipilih.',
            'satuan_obat_id.exists' => 'Satuan obat tidak ditemukan.',
            'jumlah.required' => 'Jumlah stok wajib diisi.',
            'jumlah.integer' => 'Jumlah stok harus berupa angka.',
            'jumlah.min' => 'Jumlah stok minimal 1.',
        ]);

        DB::beginTransaction();

        try {
            // Cari stok berdasarkan obat dan satuannya
            $stokObat = StokObat::where('obat_id', $validated['obat_id'])
                ->where('satuan_obat_id', $validated['satuan_obat_id'])
                ->lockForUpdate()
                ->first();

            // Jika stok belum tersedia, buat data baru
            if (!$stokObat) {
                $stokObat = StokObat::create([
                    'obat_id' => $validated['obat_id'],
                    'satuan_obat_id' => $validated['satuan_obat_id'],
                    'harga_jual' => 0,
                    'stok_tersedia' => 0,
                ]);
            }

            // Tambahkan stok
            $stokObat->stok_tersedia += $validated['jumlah'];
            $stokObat->save();

            // Simpan log dengan nilai stok terbaru
            LogStokObat::create([
                'obat_id' => $stokObat->obat_id,
                'stok_obat_id' => $stokObat->id,
                'nilai' => $stokObat->stok_tersedia,
                'tanggal_update' => now(),
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Stok obat berhasil diperbarui.');

        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui stok: ' . $e->getMessage());
        }
    }
}
