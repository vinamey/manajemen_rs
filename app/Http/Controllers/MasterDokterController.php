<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPoli;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class MasterDokterController extends Controller
{
    /**
     * Halaman Master Dokter
     */
    public function index()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.index', compact('polis'));
    }

    /**
     * Data dokter untuk Yajra DataTables
     */
    public function data()
    {
        $dokters = MasterDokter::with('poli')
            ->select('master_dokters.*')
            ->orderBy('id', 'desc');

        return DataTables::of($dokters)

            ->addIndexColumn()

            /*
            |--------------------------------------------------------------------------
            | Data asli untuk Modal
            |--------------------------------------------------------------------------
            */
            ->addColumn('jenis_kelamin_raw', function ($dokter) {
                return $dokter->jenis_kelamin;
            })

           ->addColumn('tanggal_lahir_raw', function ($dokter) {
    return $dokter->tanggal_lahir
        ? Carbon::parse($dokter->tanggal_lahir)->format('Y-m-d')
        : '';
})

            ->addColumn('spesialis_raw', function ($dokter) {
                return $dokter->spesialis;
            })

            ->addColumn('alamat_raw', function ($dokter) {
                return $dokter->alamat;
            })

            ->addColumn('poli_id_raw', function ($dokter) {
                return $dokter->poli_id;
            })

            /*
            |--------------------------------------------------------------------------
            | Jenis Kelamin
            |--------------------------------------------------------------------------
            */
            ->editColumn('jenis_kelamin', function ($dokter) {

                if (
                    $dokter->jenis_kelamin === 'laki-laki' ||
                    $dokter->jenis_kelamin === 'laki_laki'
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

            /*
            |--------------------------------------------------------------------------
            | Tanggal Lahir
            |--------------------------------------------------------------------------
            */
            ->editColumn('tanggal_lahir', function ($dokter) {

                if (!$dokter->tanggal_lahir) {
                    return '-';
                }

                return Carbon::parse(
                    $dokter->tanggal_lahir
                )->format('d-m-Y');
            })

            /*
            |--------------------------------------------------------------------------
            | Spesialis
            |--------------------------------------------------------------------------
            */
            ->editColumn('spesialis', function ($dokter) {

                if (!$dokter->spesialis) {
                    return '-';
                }

                return e($dokter->spesialis);
            })

            /*
            |--------------------------------------------------------------------------
            | Poli
            |--------------------------------------------------------------------------
            */
            ->addColumn('poli', function ($dokter) {

                if (!$dokter->poli) {
                    return '-';
                }

                return e($dokter->poli->nama);
            })

            /*
            |--------------------------------------------------------------------------
            | Alamat
            |--------------------------------------------------------------------------
            */
            ->editColumn('alamat', function ($dokter) {

                return $dokter->alamat
                    ? e($dokter->alamat)
                    : '-';
            })

            /*
            |--------------------------------------------------------------------------
            | Tombol Aksi
            |--------------------------------------------------------------------------
            */
            ->addColumn('aksi', function ($dokter) {

                $deleteUrl = route(
                    'master-dokter.destroy',
                    $dokter->id
                );

                $csrf = csrf_token();

                return '
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn-action btn-view"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                        </button>

                        <button
                            type="button"
                            class="btn-action btn-edit"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                        </button>

                        <form
                            action="' . $deleteUrl . '"
                            method="POST"
                            class="form-delete-dokter d-inline"
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

                    </div>
                ';
            })

            ->rawColumns([
                'jenis_kelamin',
                'aksi'
            ])

            ->make(true);
    }

    /**
     * Form tambah lama.
     * Tetap dipertahankan.
     */
    public function create()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view(
            'master-dokter.create',
            compact('polis')
        );
    }

    /**
     * Simpan dokter
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',

            'jenis_kelamin' =>
                'required|in:laki-laki,perempuan',

            'tanggal_lahir' =>
                'required|date',

            'spesialis' =>
                'nullable|string|max:255',

            'alamat' =>
                'nullable|string',

            'poli_id' =>
                'nullable|exists:master_polis,id',
        ]);

        $dokter = MasterDokter::create(
            $validated
        );

        /*
        |--------------------------------------------------------------------------
        | Jika dikirim dari AJAX/modal
        |--------------------------------------------------------------------------
        */
        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Data dokter berhasil ditambahkan.',
                'data' => $dokter,
            ]);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with(
                'success',
                'Data dokter berhasil ditambahkan.'
            );
    }

    /**
     * Detail dokter
     */
    public function show(Request $request, string $id)
    {
        $dokter = MasterDokter::with('poli')
            ->findOrFail($id);

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'data' => $dokter,
            ]);
        }

        return view(
            'master-dokter.show',
            compact('dokter')
        );
    }

    /**
     * Edit dokter
     */
    public function edit(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'data' => $dokter,
            ]);
        }

        $polis = MasterPoli::orderBy(
            'nama',
            'asc'
        )->get();

        return view(
            'master-dokter.edit',
            compact('dokter', 'polis')
        );
    }

    /**
     * Update dokter
     */
    public function update(
        Request $request,
        string $id
    ) {
        $dokter = MasterDokter::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Spesialis sengaja TIDAK diubah saat Edit
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'nama' => 'required|string|max:255',

            'jenis_kelamin' =>
                'required|in:laki-laki,perempuan',

            'tanggal_lahir' =>
                'required|date',

            'alamat' =>
                'nullable|string',

            'poli_id' =>
                'nullable|exists:master_polis,id',
        ]);

        $dokter->update(
            $validated
        );

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Data dokter berhasil diperbarui.',
                'data' => $dokter->fresh(),
            ]);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with(
                'success',
                'Data dokter berhasil diperbarui.'
            );
    }

    /**
     * Hapus dokter
     */
    public function destroy(
        Request $request,
        string $id
    ) {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Data dokter berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with(
                'success',
                'Data dokter berhasil dihapus.'
            );
    }
}
