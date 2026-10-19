<?php

namespace App\Http\Controllers;

use App\Models\MasterPasien;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class MasterPasienController extends Controller
{
   // HALAMAN MASTER PASIEN SUPER ADMIN
public function index()
{
    return view('master-pasien.index');
}

// HALAMAN DATA PASIEN KHUSUS DOKTER
public function indexDokter()
{
    $pasien = MasterPasien::orderBy('id', 'desc')
        ->paginate(10);

    return view('dokter.data-pasien', compact('pasien'));
}


    public function data()
    {
        $pasiens = MasterPasien::query()
            ->orderBy('id', 'desc');

        return DataTables::of($pasiens)

            ->addIndexColumn()


            /* =====================================================
               DATA ASLI UNTUK MODAL
            ====================================================== */

            ->addColumn('jenis_kelamin_raw', function ($pasien) {
                return $pasien->jenis_kelamin;
            })

            ->addColumn('tanggal_lahir_raw', function ($pasien) {
                return $pasien->tanggal_lahir;
            })

            ->addColumn('golongan_darah_raw', function ($pasien) {
                return $pasien->golongan_darah;
            })

            ->addColumn('status_asuransi_raw', function ($pasien) {
                return $pasien->status_asuransi;
            })


            /* =====================================================
               JENIS KELAMIN
            ====================================================== */

            ->editColumn('jenis_kelamin', function ($pasien) {

                if (
                    $pasien->jenis_kelamin === 'laki-laki' ||
                    $pasien->jenis_kelamin === 'laki_laki'
                ) {
                    return '
                        <span class="badge-gender">
                            <i class="fas fa-mars"></i>
                            Laki-laki
                        </span>
                    ';
                }

                return '
                    <span class="badge-gender">
                        <i class="fas fa-venus"></i>
                        Perempuan
                    </span>
                ';
            })


            /* =====================================================
               TANGGAL LAHIR
            ====================================================== */

            ->editColumn('tanggal_lahir', function ($pasien) {

                if (!$pasien->tanggal_lahir) {
                    return '-';
                }

                return Carbon::parse(
                    $pasien->tanggal_lahir
                )->format('d-m-Y');
            })


            /* =====================================================
               ALAMAT
            ====================================================== */

            ->editColumn('alamat', function ($pasien) {

                return $pasien->alamat ?: '-';

            })


            /* =====================================================
               GOLONGAN DARAH
            ====================================================== */

            ->editColumn('golongan_darah', function ($pasien) {

                if (!$pasien->golongan_darah) {
                    return '-';
                }

                return '
                    <span class="badge-darah">
                        <i class="fas fa-droplet"></i>
                        ' . e($pasien->golongan_darah) . '
                    </span>
                ';
            })


            /* =====================================================
               STATUS ASURANSI
            ====================================================== */

            ->editColumn('status_asuransi', function ($pasien) {

                if (
                    $pasien->status_asuransi === '01' ||
                    $pasien->status_asuransi == 1
                ) {
                    return '
                        <span class="badge-asuransi aktif">
                            <i class="fas fa-shield-heart"></i>
                            Memiliki Asuransi
                        </span>
                    ';
                }

                return '
                    <span class="badge-asuransi tidak">
                        <i class="fas fa-circle-xmark"></i>
                        Tidak Memiliki Asuransi
                    </span>
                ';
            })


            /* =====================================================
               AKSI
            ====================================================== */

            ->addColumn('aksi', function ($pasien) {

                /*
                -----------------------------------------------------
                TOMBOL LIHAT
                Semua role yang boleh membuka Master Pasien
                tetap bisa melihat detail.
                -----------------------------------------------------
                */

                $aksi = '
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn-action btn-view"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                ';


                /*
                -----------------------------------------------------
                EDIT & HAPUS
                Hanya Super Admin dan Admin Rumah Sakit.
                -----------------------------------------------------
                */

                if (
                    auth()->user()->hasAnyRole([
                        'super admin',
                        'admin rumah sakit'
                    ])
                ) {

                    /*
                    URL DELETE
                    */

                    $deleteUrl = route(
                        'master-pasien.destroy',
                        $pasien->id
                    );


                    /*
                    CSRF
                    */

                    $csrf = csrf_token();


                    /*
                    TAMBAHKAN TOMBOL EDIT
                    */

                    $aksi .= '
                        <button
                            type="button"
                            class="btn-action btn-edit"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                    ';


                    /*
                    TAMBAHKAN FORM HAPUS
                    */

                    $aksi .= '
                        <form
                            action="' . $deleteUrl . '"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm(\'Yakin ingin menghapus data pasien ini?\');"
                        >

                            <input
                                type="hidden"
                                name="_token"
                                value="' . $csrf . '"
                            >

                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            >

                            <button
                                type="submit"
                                class="btn-action btn-delete"
                                title="Hapus"
                            >
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                    ';
                }


                /*
                -----------------------------------------------------
                TUTUP DIV AKSI
                -----------------------------------------------------
                */

                $aksi .= '
                    </div>
                ';


                return $aksi;
            })


            /* =====================================================
               RAW HTML
            ====================================================== */

            ->rawColumns([
                'jenis_kelamin',
                'golongan_darah',
                'status_asuransi',
                'aksi'
            ])


            ->make(true);
    }


    /* =========================================================
       CREATE
    ========================================================= */

    public function create()
    {
        return view('master-pasien.create');
    }


    /* =========================================================
       STORE
    ========================================================= */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'status_asuransi' => 'required|in:01,0',
            'golongan_darah' => 'required|in:A,B,AB,O',
        ]);


        MasterPasien::create($validated);


        return redirect()
            ->route('master-pasien.index')
            ->with(
                'success',
                'Data pasien berhasil ditambahkan.'
            );
    }


    /* =========================================================
       SHOW
    ========================================================= */

    public function show(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);


        return view(
            'master-pasien.show',
            compact('pasien')
        );
    }


    /* =========================================================
       EDIT
    ========================================================= */

    public function edit(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);


        return view(
            'master-pasien.edit',
            compact('pasien')
        );
    }


    /* =========================================================
       UPDATE
    ========================================================= */

    public function update(Request $request, string $id)
    {
        $pasien = MasterPasien::findOrFail($id);


        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'status_asuransi' => 'required|in:01,0',
            'golongan_darah' => 'required|in:A,B,AB,O',
        ]);


        $pasien->update($validated);


        return redirect()
            ->route('master-pasien.index')
            ->with(
                'success',
                'Data pasien berhasil diperbarui.'
            );
    }


    /* =========================================================
       DESTROY
    ========================================================= */

    public function destroy(string $id)
    {
        $pasien = MasterPasien::findOrFail($id);


        $pasien->delete();


        return redirect()
            ->route('master-pasien.index')
            ->with(
                'success',
                'Data pasien berhasil dihapus.'
            );
    }
}
