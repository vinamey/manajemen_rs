<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
        ->latest()
        ->paginate(10);

        return view('kasir.pembayaran', compact('resepObats'));
    }

    public function proses(Request $request, $id)
    {
        $request->validate([
            'total_pembayaran' => 'required|numeric|min:0.01',
        ]);

        $resep = ResepObat::findOrFail($id);

        if ($resep->obat()->count() === 0) {
            return back()->with(
                'error',
                'Resep ini belum memiliki obat.'
            );
        }

        DB::transaction(function () use ($resep, $request) {
            Pembayaran::create([
                'resep_id' => $resep->id,
                'total_pembayaran' => $request->total_pembayaran,
            ]);
        });

        return redirect()
            ->route('kasir.pembayaran')
            ->with('success', 'Catatan pembayaran berhasil disimpan.');
    }
}
