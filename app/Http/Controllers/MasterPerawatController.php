<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class MasterPerawatController extends Controller
{
    /**
     * Halaman Master Perawat
     */
    public function index()
    {
        return view('master-perawat.index');
    }

    /**
     * Data Perawat untuk Yajra DataTables
     */
    public function data()
    {
        $perawats = MasterPerawat::query()
            ->orderBy('id', 'desc');

        return DataTables::of($perawats)

            ->addIndexColumn()

            /*
            |--------------------------------------------------------------------------
            | Data asli untuk Modal
            |--------------------------------------------------------------------------
            */

            ->addColumn('jenis_kelamin_raw', function ($perawat) {
                return $perawat->jenis_kelamin;
            })

            ->addColumn('tanggal_lahir_raw', function ($perawat) {
                return $perawat->tanggal_lahir
                    ? Carbon::parse($perawat->tanggal_lahir)->format('Y-m-d')
                    : '';
            })

            ->addColumn('alamat_raw', function ($perawat) {
                return $perawat->alamat;
            })

            /*
            |--------------------------------------------------------------------------
            | Jenis Kelamin
            |--------------------------------------------------------------------------
            */

            ->editColumn('jenis_kelamin', function ($perawat) {

                if (
                    $perawat->jenis_kelamin === 'laki-laki' ||
                    $perawat->jenis_kelamin === 'laki_laki'
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

            ->editColumn('tanggal_lahir', function ($perawat) {

                if (!$perawat->tanggal_lahir) {
                    return '-';
                }

                return Carbon::parse(
                    $perawat->tanggal_lahir
                )->format('d-m-Y');
            })

            /*
            |--------------------------------------------------------------------------
            | Alamat
            |--------------------------------------------------------------------------
            */

            ->editColumn('alamat', function ($perawat) {
                return $perawat->alamat
                    ? e($perawat->alamat)
                    : '-';
            })

            /*
            |--------------------------------------------------------------------------
            | Tombol Aksi
            |--------------------------------------------------------------------------
            */

            ->addColumn('aksi', function ($perawat) {

                $deleteUrl = route(
                    'master-perawat.destroy',
                    $perawat->id
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
                            class="d-inline"
                            onsubmit="return confirm(\'Yakin ingin menghapus data perawat ini?\');"
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
     * Form tambah lama
     */
    public function create()
    {
        return view('master-perawat.create');
    }

    /**
     * Simpan Perawat
     */
    public function store(Request $request)
    {
        $request->merge([
            'jenis_kelamin' => strtolower(
                $request->jenis_kelamin
            ),
        ]);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ], [
            'nama.required' =>
                'Nama perawat wajib diisi.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'jenis_kelamin.in' =>
                'Jenis kelamin harus Laki-laki atau Perempuan.',

            'tanggal_lahir.required' =>
                'Tanggal lahir wajib diisi.',

            'tanggal_lahir.date' =>
                'Format tanggal lahir tidak valid.',

            'alamat.required' =>
                'Alamat wajib diisi.',
        ]);

        MasterPerawat::create($validated);

        return redirect()
            ->route('master-perawat.index')
            ->with(
                'success',
                'Data perawat berhasil ditambahkan.'
            );
    }

    /**
     * Detail Perawat
     */
    public function show(MasterPerawat $master_perawat)
    {
        return view('master-perawat.show', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Form Edit lama
     */
    public function edit(MasterPerawat $master_perawat)
    {
        return view('master-perawat.edit', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Update Perawat
     */
    public function update(
        Request $request,
        MasterPerawat $master_perawat
    ) {
        $request->merge([
            'jenis_kelamin' => strtolower(
                $request->jenis_kelamin
            ),
        ]);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ], [
            'nama.required' =>
                'Nama perawat wajib diisi.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'jenis_kelamin.in' =>
                'Jenis kelamin harus Laki-laki atau Perempuan.',

            'tanggal_lahir.required' =>
                'Tanggal lahir wajib diisi.',

            'tanggal_lahir.date' =>
                'Format tanggal lahir tidak valid.',

            'alamat.required' =>
                'Alamat wajib diisi.',
        ]);

        $master_perawat->update($validated);

        return redirect()
            ->route('master-perawat.index')
            ->with(
                'success',
                'Data perawat berhasil diperbarui.'
            );
    }

    /**
     * Hapus Perawat
     */
    public function destroy(
        MasterPerawat $master_perawat
    ) {
        $master_perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with(
                'success',
                'Data perawat berhasil dihapus.'
            );
    }
}
