<?php

namespace App\Http\Controllers;

use App\Models\MasterPasien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MasterPasienController extends Controller
{
    // ==========================================
    // HALAMAN MASTER PASIEN SUPER ADMIN
    // ==========================================
    public function index()
    {
        return view('master-pasien.index');
    }

    // ==========================================
    // DATA MASTER PASIEN SUPER ADMIN (DATATABLES)
    // ==========================================
    public function data()
    {
        $pasiens = MasterPasien::query()
            ->select([
                'id',
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'alamat',
                'golongan_darah',
                'status_asuransi',
            ])
            ->orderBy('id', 'desc');

        return DataTables::of($pasiens)
            ->addIndexColumn()
            ->addColumn('jenis_kelamin_raw', function ($pasien) {
                return $pasien->jenis_kelamin ?? '-';
            })
            ->addColumn('tanggal_lahir_raw', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })
            ->addColumn('alamat_raw', function ($pasien) {
                return $pasien->alamat ?? '-';
            })
            ->addColumn('golongan_darah_raw', function ($pasien) {
                return $pasien->golongan_darah ?? '-';
            })
            ->addColumn('status_asuransi_raw', function ($pasien) {
                return $pasien->status_asuransi ?? '-';
            })
            ->editColumn('jenis_kelamin', function ($pasien) {
                return $pasien->jenis_kelamin ?: '-';
            })
            ->editColumn('tanggal_lahir', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })
            ->editColumn('alamat', function ($pasien) {
                return $pasien->alamat ?: '-';
            })
            ->editColumn('golongan_darah', function ($pasien) {
                return $pasien->golongan_darah ?: '-';
            })
            ->editColumn('status_asuransi', function ($pasien) {
                return $this->formatStatusAsuransi(
                    $pasien->status_asuransi
                );
            })

->addColumn('aksi', function ($pasien) {
    return '
        <button type="button"
            class="btn-view"
            title="Lihat Detail">
            <i class="fas fa-eye"></i>
        </button>
    ';
})

            ->rawColumns(['aksi'])
            ->make(true);
    }

    // ==========================================
    // HALAMAN DATA PASIEN ADMIN RUMAH SAKIT
    // ==========================================
    public function indexAdmin()
    {
        return view('admin.data-pasien');
    }

    // ==========================================
    // DATA PASIEN ADMIN RS (DATATABLES)
    // ==========================================
    public function dataAdmin()
    {
        $pasiens = MasterPasien::query()
            ->select([
                'id',
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'alamat',
                'golongan_darah',
                'status_asuransi',
            ])
            ->orderBy('id', 'desc');

        return DataTables::of($pasiens)
            ->addIndexColumn()

            // Data asli untuk modal detail
            ->addColumn('jenis_kelamin_raw', function ($pasien) {
                return $pasien->jenis_kelamin ?? '-';
            })
            ->addColumn('tanggal_lahir_raw', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })
            ->addColumn('alamat_raw', function ($pasien) {
                return $pasien->alamat ?? '-';
            })
            ->addColumn('golongan_darah_raw', function ($pasien) {
                return $pasien->golongan_darah ?? '-';
            })
            ->addColumn('status_asuransi_raw', function ($pasien) {
                return $pasien->status_asuransi ?? '-';
            })

            // Jenis kelamin tanpa badge warna
            ->editColumn('jenis_kelamin', function ($pasien) {
                return $pasien->jenis_kelamin ?: '-';
            })

            // Tanggal lahir
            ->editColumn('tanggal_lahir', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })

            // Alamat
            ->editColumn('alamat', function ($pasien) {
                return $pasien->alamat ?: '-';
            })

            // Golongan darah
            ->editColumn('golongan_darah', function ($pasien) {
                return $pasien->golongan_darah ?: '-';
            })

            // Status asuransi tanpa badge warna
            ->editColumn('status_asuransi', function ($pasien) {
                return $this->formatStatusAsuransi(
                    $pasien->status_asuransi
                );
            })

            // Tombol lihat detail
            ->addColumn('aksi', function ($pasien) {
                return '
                    <button type="button"
                        class="btn btn-sm btn-outline-primary btn-lihat"
                        title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                ';
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    // ==========================================
    // DETAIL PASIEN ADMIN RS
    // ==========================================
    public function showAdmin(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        return view('admin.show-pasien', compact('pasien'));
    }

    // ==========================================
    // HALAMAN DATA PASIEN DOKTER
    // ==========================================
    public function indexDokter()
    {
        $pasien = MasterPasien::orderBy('id', 'desc')->paginate(10);

        return view('dokter.data-pasien', compact('pasien'));
    }

    // ==========================================
    // HALAMAN DATA PASIEN PERAWAT
    // ==========================================
    public function indexPerawat()
    {
        return view('perawat.data-pasien');
    }

    // ==========================================
    // DATA PASIEN PERAWAT (DATATABLES)
    // ==========================================
    public function dataPerawat()
    {
        $pasiens = MasterPasien::query()
            ->select([
                'id',
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'alamat',
                'golongan_darah',
                'status_asuransi',
            ])
            ->orderBy('id', 'desc');

        return DataTables::of($pasiens)
            ->addIndexColumn()
            ->editColumn('tanggal_lahir', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })
            ->editColumn('alamat', function ($pasien) {
                return $pasien->alamat ?: '-';
            })
            ->make(true);
    }

    // ==========================================
    // FORMAT STATUS ASURANSI
    // ==========================================
    private function formatStatusAsuransi($status)
    {
        if ($status === '01' || $status == 1) {
            return 'Memiliki Asuransi';
        }

        if ($status === null || $status === '') {
            return '-';
        }

        return 'Tidak Memiliki Asuransi';
    }
}
