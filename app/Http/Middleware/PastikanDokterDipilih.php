<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterDokter;
use Symfony\Component\HttpFoundation\Response;

class PastikanDokterDipilih
{
    public function handle(Request $request, Closure $next): Response
    {
        $dokterId = $request->session()->get('dokter_aktif_id');

        // Jika belum memilih dokter
        if (!$dokterId) {
            return redirect()->route('dokter.pilih');
        }

        // Jika dokter sudah tidak tersedia
        if (!MasterDokter::whereKey($dokterId)->exists()) {
            $request->session()->forget('dokter_aktif_id');

            return redirect()
                ->route('dokter.pilih')
                ->with('error', 'Data dokter tidak ditemukan. Silakan pilih kembali.');
        }

        return $next($request);
    }
}
