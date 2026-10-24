<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\LogStokObat;
use Illuminate\Http\Request;

class StokObatController extends Controller
{
    public function storeStok(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string', 
        ]);

        $obat = Obat::findOrFail($request->obat_id);
        $obat->stok += $request->jumlah;
        $obat->save();

        LogStokObat::create([
            'obat_id' => $obat->id,
            'tanggal_update' => now(),
            'status' => $request->status, 
            'jumlah' => $request->jumlah,
            'stok_tersedia' => $obat->stok,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('log-stok-obat.index')->with('success', 'Log stok obat berhasil diperbarui.');
    }
}