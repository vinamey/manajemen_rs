<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Exports\LaporanExport;
use App\Models\StokObat;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Mengambil data pembayaran yang sudah LUNAS.
     * Sumber data disamakan dengan LaporanExport.
     */
    private function getPendapatanLunas()
    {
        $table = 'pembayarans';
        $columns = Schema::getColumnListing($table);

        // Cari kolom status
        $statusColumn = null;

        foreach (['status', 'status_pembayaran'] as $column) {
            if (in_array($column, $columns)) {
                $statusColumn = $column;
                break;
            }
        }

        if (!$statusColumn) {
            throw new \RuntimeException('Kolom status tidak ditemukan pada tabel pembayarans.');
        }

        // Cari kolom jumlah pembayaran
        $amountColumn = null;

        foreach (['total_pembayaran', 'total_bayar', 'jumlah_bayar', 'nominal', 'jumlah', 'total'] as $column) {
            if (in_array($column, $columns)) {
                $amountColumn = $column;
                break;
            }
        }

        if (!$amountColumn) {
            throw new \RuntimeException('Kolom jumlah pembayaran tidak ditemukan.');
        }

        // Cari kolom tanggal
        $dateColumn = null;

        foreach (['tanggal_pembayaran', 'tanggal_bayar', 'tanggal', 'created_at'] as $column) {
            if (in_array($column, $columns)) {
                $dateColumn = $column;
                break;
            }
        }

        // Cari kolom keterangan
        $descriptionColumn = null;

        foreach (['keterangan', 'deskripsi', 'nama_pembayaran'] as $column) {
            if (in_array($column, $columns)) {
                $descriptionColumn = $column;
                break;
            }
        }

        // Ambil pembayaran yang LUNAS saja
        $payments = DB::table($table)
            ->whereRaw("UPPER(TRIM(`{$statusColumn}`)) = ?", ['LUNAS'])
            ->orderBy('id', 'asc')
            ->get();

        // Samakan format data dengan Excel
        return $payments->map(function ($item) use ($amountColumn, $dateColumn, $descriptionColumn, $columns) {
            $keterangan = '-';

            if ($descriptionColumn) {
                $keterangan = $item->{$descriptionColumn} ?? '-';
            } else {
                $keterangan = 'Pembayaran #' . $item->id;
            }

            if (in_array('metode_pembayaran', $columns)) {
                $metode = $item->metode_pembayaran ?? '';

                if ($metode != '') {
                    $keterangan .= ' - ' . $metode;
                }
            }

            $tanggal = '-';

            if ($dateColumn && !empty($item->{$dateColumn})) {
                $tanggal = Carbon::parse($item->{$dateColumn})->format('d-m-Y');
            }

            return (object) [
                'id' => $item->id,
                'keterangan' => $keterangan,
                'jumlah' => $item->{$amountColumn},
                'tanggal' => $tanggal,
            ];
        });
    }

    public function index()
    {
        $totalPasien = DB::table('pasiens')->count();

        $totalPendapatan = $this->getPendapatanLunas()->sum('jumlah');

        $totalObat = DB::table('master_obats')->count();

        return view('direktur.laporan', compact('totalPasien', 'totalPendapatan', 'totalObat'));
    }

    public function exportExcel($type)
    {
        return Excel::download(new LaporanExport($type), 'Laporan_' . ucfirst($type) . '_' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf($type)
{
    if ($type == 'pasien') {

        $query = DB::table('pendaftaran_pasiens')
            ->leftJoin(
                'master_pasiens',
                'pendaftaran_pasiens.pasien_id',
                '=',
                'master_pasiens.id'
            )
            ->select(
                'pendaftaran_pasiens.tanggal_pendaftaran',
                'master_pasiens.nama as nama_pasien',
                'master_pasiens.jenis_kelamin'
            )
            ->selectSub(function ($subquery) {
                $subquery->from('pasiens')
                    ->select('no_rekam_medis')
                    ->whereRaw(
                        'LOWER(TRIM(pasiens.nama_pasien)) = LOWER(TRIM(master_pasiens.nama))'
                    )
                    ->whereRaw(
                        'LOWER(TRIM(pasiens.jenis_kelamin)) = LOWER(TRIM(master_pasiens.jenis_kelamin))'
                    )
                    ->orderBy('id', 'asc')
                    ->limit(1);
            }, 'no_rekam_medis')
            ->orderBy('pendaftaran_pasiens.id', 'asc');

        if (Schema::hasColumn('pendaftaran_pasiens', 'deleted_at')) {
            $query->whereNull('pendaftaran_pasiens.deleted_at');
        }

        $data = $query->get();

    } elseif ($type == 'pendapatan') {

        $data = $this->getPendapatanLunas();

    } elseif ($type == 'data-obat') {

        $data = StokObat::with('obat')
            ->orderBy('id', 'asc')
            ->get();

    } else {
        abort(404);
    }

    $pdf = Pdf::loadView(
        'direktur.laporanpdf',
        compact('data', 'type')
    )->setPaper('a4', 'portrait');

    return $pdf->stream('laporan-' . $type . '.pdf');
}
    }
