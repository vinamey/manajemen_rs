<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use App\Models\StokObat;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPasien = DB::table('pasiens')->count();

        $totalPendapatan = DB::table('pendapatan')
            ->sum('jumlah');

        $totalObat = DB::table('master_obats')->count();

        return view('direktur.laporan', compact(
            'totalPasien',
            'totalPendapatan',
            'totalObat'
        ));
    }

    public function exportExcel($type)
    {
        return Excel::download(
            new LaporanExport($type),
            'Laporan_' . ucfirst($type) . '_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function exportPdf($type)
    {
        if ($type == 'pasien') {

            $data = DB::table('pasiens')->get();

        } elseif ($type == 'pendapatan') {

            $data = DB::table('pendapatan')->get();

        } elseif ($type == 'apotek') {

            // Ambil data stok beserta relasi master obat
            $data = StokObat::with('obat')
                ->orderBy('obat_id', 'asc')
                ->get();

        } else {
            abort(404);
        }

        $pdf = Pdf::loadView(
            'direktur.laporanpdf',
            compact('data', 'type')
        )->setPaper('a4', 'portrait');

        return $pdf->stream(
            'Laporan_' . ucfirst($type) . '_' . date('Y-m-d') . '.pdf'
        );
    }
}
