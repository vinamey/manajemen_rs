<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPasien;
use App\Models\MasterPerawat;
use App\Models\MasterObat;
use App\Models\MasterKamar;
use App\Models\PendaftaranPasien;
use App\Models\Pembayaran;
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

            // Nama bulan
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

            $tahun = Carbon::now()->year;

            // Bulan yang dipilih
            $bulan = (int) $request->query('bulan', Carbon::now()->month);

            if ($bulan < 1 || $bulan > 12) {
                $bulan = Carbon::now()->month;
            }

            // Total pendapatan sesuai bulan yang dipilih
            $pendapatan = Pembayaran::where('status', 'LUNAS')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->sum('total_pembayaran');

            // Grafik 6 bulan sampai bulan yang dipilih
            $grafikPendapatan = [];

            for ($i = 5; $i >= 0; $i--) {

                $tanggal = Carbon::create($tahun, $bulan, 1)
                    ->subMonths($i);

                $total = Pembayaran::where('status', 'LUNAS')
                    ->whereYear('created_at', $tanggal->year)
                    ->whereMonth('created_at', $tanggal->month)
                    ->sum('total_pembayaran');

                $grafikPendapatan[] = [
                    'bulan' => $namaBulan[$tanggal->month],
                    'total' => $total,
                ];
            }

            // Nilai tertinggi untuk ukuran grafik
            $maksimalGrafik = max(
                array_column($grafikPendapatan, 'total')
            );

            foreach ($grafikPendapatan as &$item) {
                $item['tinggi'] = $maksimalGrafik > 0
                    ? max(5, ($item['total'] / $maksimalGrafik) * 100)
                    : 5;
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
