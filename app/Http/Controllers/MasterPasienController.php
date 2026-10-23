<?php
namespace App\Http\Controllers;

use App\Models\MasterPasien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MasterPasienController extends Controller
{
    // HALAMAN MASTER PASIEN
    public function index()
    {
        return view('master-pasien.index');
    }

    // TAMBAH PASIEN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,L,P,laki_laki',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'status_asuransi' => 'required|in:01,0,1',
        ]);

        try {
            $validated['jenis_kelamin'] = $this->normalisasiJenisKelamin(
                $validated['jenis_kelamin']
            );

            MasterPasien::create($validated);

            return back()->with('success', 'Data pasien berhasil disimpan!');
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan data pasien. Periksa model dan database.',
            ]);
        }
    }

    // UPDATE PASIEN
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,L,P,laki_laki',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'status_asuransi' => 'required|in:01,0,1',
        ]);

        try {
            $pasien = MasterPasien::findOrFail($id);

            $validated['jenis_kelamin'] = $this->normalisasiJenisKelamin(
                $validated['jenis_kelamin']
            );

            $pasien->update($validated);

            return back()->with('success', 'Data pasien berhasil diperbarui!');
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->withErrors([
                'error' => 'Gagal memperbarui data pasien. Periksa model dan database.',
            ]);
        }
    }

    // HAPUS PASIEN
    public function destroy($id)
    {
        try {
            $pasien = MasterPasien::findOrFail($id);
            $pasien->delete();

            return back()->with('success', 'Data pasien berhasil dihapus!');
        } catch (\Throwable $e) {
            report($e);

            return back()->withErrors([
                'error' => 'Gagal menghapus data pasien.',
            ]);
        }
    }

    // DATA DATATABLES MASTER PASIEN
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
            ->orderByDesc('id');

        return DataTables::of($pasiens)
            ->addIndexColumn()

            // DATA ASLI UNTUK MODAL EDIT
            ->addColumn('jenis_kelamin_raw', function ($pasien) {
                return $pasien->jenis_kelamin ?? '';
            })
            ->addColumn('tanggal_lahir_raw', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('Y-m-d')
                    : '';
            })
            ->addColumn('golongan_darah_raw', function ($pasien) {
                return $pasien->golongan_darah ?? '';
            })
            ->addColumn('status_asuransi_raw', function ($pasien) {
                return (string) ($pasien->status_asuransi ?? '');
            })

            // FORMAT TAMPILAN
            ->editColumn('jenis_kelamin', function ($pasien) {
                $jk = strtolower((string) $pasien->jenis_kelamin);

                if (in_array($jk, ['l', 'laki_laki', 'laki-laki'])) {
                    return 'Laki-laki';
                }

                if (in_array($jk, ['p', 'perempuan'])) {
                    return 'Perempuan';
                }

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

            // TOMBOL LIHAT, EDIT, HAPUS
            ->addColumn('aksi', function ($pasien) {
                $html = '
                    <div class="action-buttons">
                        <button type="button"
                            class="btn-action btn-view"
                            title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                ';

                if (auth()->user()->hasAnyRole([
                    'super admin',
                    'admin rumah sakit',
                ])) {
                    $html .= '
                        <button type="button"
                            class="btn-action btn-edit"
                            title="Edit Pasien">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="' .
                            route('master-pasien.destroy', $pasien->id) .
                            '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit"
                                class="btn-action btn-delete"
                                title="Hapus Pasien">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    ';
                }

                return $html . '</div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // HALAMAN ADMIN RUMAH SAKIT
    public function indexAdmin()
    {
        return view('admin.data-pasien');
    }

    // DATA PASIEN ADMIN RUMAH SAKIT
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
            ->orderByDesc('id');

        return DataTables::of($pasiens)
            ->addIndexColumn()
            ->editColumn('tanggal_lahir', function ($pasien) {
                return $pasien->tanggal_lahir
                    ? Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })
            ->editColumn('status_asuransi', function ($pasien) {
                return $this->formatStatusAsuransi(
                    $pasien->status_asuransi
                );
            })
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

    // DETAIL PASIEN ADMIN
    public function showAdmin(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);

        return view('admin.show-pasien', compact('pasien'));
    }

    // HALAMAN PASIEN DOKTER
    public function indexDokter()
    {
        $pasien = MasterPasien::orderByDesc('id')->paginate(10);

        return view('dokter.data-pasien', compact('pasien'));
    }

    // HALAMAN PASIEN PERAWAT
    public function indexPerawat()
    {
        return view('perawat.data-pasien');
    }

    // DATA PASIEN PERAWAT
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
            ->orderByDesc('id');

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
    // NORMALISASI JENIS KELAMIN
    private function normalisasiJenisKelamin($jk)
    {
        $jk = strtolower((string) $jk);

        if (in_array($jk, ['l', 'laki_laki', 'laki-laki'])) {
            return 'laki-laki';
        }

        return 'perempuan';
    }

    // ==========================================
    // SIMPAN DATA MASTER PASIEN
    // ==========================================

    // ==========================================
    // FORMAT STATUS ASURANSI
    private function formatStatusAsuransi($status)
    {
        if (in_array((string) $status, ['01', '1'], true)) {
            return 'Memiliki Asuransi';
        }

        if ($status === null || $status === '') {
            return '-';
        }

        return 'Tidak Memiliki Asuransi';
    }
}
