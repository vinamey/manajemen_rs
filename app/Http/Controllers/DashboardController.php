<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPasien;
use App\Models\MasterPerawat;
use App\Models\MasterObat;
use App\Models\MasterKamar;
use App\Models\PendaftaranPasien;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $totalUser = User::count();
        $totalPasien = MasterPasien::count();
        $totalDokter = MasterDokter::count();
        $totalPerawat = MasterPerawat::count();
        $totalObat = MasterObat::count();
        $totalKamar = MasterKamar::count();

        $totalPendaftaran = PendaftaranPasien::whereDate(
            'tanggal_pendaftaran',
            Carbon::today()
        )->count();

        if (strtolower($user->getRoleNames()->first() ?? '') === 'direktur') {

            $namaBulan = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];

            // Mengambil bulan dan tahun yang dipilih
            $bulan = (int) $request->query('bulan', Carbon::now()->month);
            $tahun = (int) $request->query('tahun', Carbon::now()->year);

            if ($bulan < 1 || $bulan > 12) {
                $bulan = Carbon::now()->month;
            }

            if ($tahun < 2000 || $tahun > 2100) {
                $tahun = Carbon::now()->year;
            }

            // Total pendapatan
            $pendapatan = Pembayaran::where('status', 'LUNAS')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->sum('total_pembayaran');

            // Total pengeluaran dari database
            $pengeluaran = Pengeluaran::whereYear(
                    'tanggal_pengeluaran',
                    $tahun
                )
                ->whereMonth('tanggal_pengeluaran', $bulan)
                ->sum('nominal');

            // Grafik pendapatan
            $grafikPendapatan = [];
            $maksimalGrafik = 0;

            for ($i = 1; $i <= 12; $i++) {

                $total = Pembayaran::where('status', 'LUNAS')
                    ->whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $i)
                    ->sum('total_pembayaran');

                $grafikPendapatan[] = [
                    'nomor' => $i,
                    'bulan' => $namaBulan[$i],
                    'singkatan' => substr($namaBulan[$i], 0, 3),
                    'total' => $total,
                ];

                $maksimalGrafik = max(
                    $maksimalGrafik,
                    (float) $total
                );
            }

            // Tinggi batang grafik
            foreach ($grafikPendapatan as &$item) {
                $item['tinggi'] = $maksimalGrafik > 0
                    ? max(
                        4,
                        ((float) $item['total'] / $maksimalGrafik) * 100
                    )
                    : 4;
            }

            unset($item);

            return view('direktur.dashboard', compact(
                'totalUser',
                'totalPasien',
                'totalDokter',
                'totalPerawat',
                'totalObat',
                'totalKamar',
                'totalPendaftaran',
                'pendapatan',
                'pengeluaran',
                'bulan',
                'tahun',
                'namaBulan',
                'grafikPendapatan'
            ));
        }

        return view('dashboard', compact(
            'totalUser',
            'totalPasien',
            'totalDokter',
            'totalPerawat',
            'totalObat',
            'totalKamar',
            'totalPendaftaran'
        ));
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }
}