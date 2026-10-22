<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class MasterPerawatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    /**
     * Halaman Master Perawat Super Admin
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

            // Data asli untuk modal
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

            // Jenis kelamin
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

            // Tanggal lahir
            ->editColumn('tanggal_lahir', function ($perawat) {
                if (!$perawat->tanggal_lahir) {
                    return '-';
                }

                return Carbon::parse(
                    $perawat->tanggal_lahir
                )->format('d-m-Y');
            })

            // Alamat
            ->editColumn('alamat', function ($perawat) {
                return $perawat->alamat
                    ? e($perawat->alamat)
                    : '-';
            })

            // Tombol aksi
            ->addColumn('aksi', function ($perawat) {
                // Bedakan route Admin RS dan Super Admin
                $isAdmin = request()->routeIs('admin.perawat.data');

                $deleteUrl = $isAdmin
                    ? route('admin.perawat.destroy', $perawat->id)
                    : route('master-perawat.destroy', $perawat->id);

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
     * Form tambah Super Admin
     */
    public function create()
    {
        return view('master-perawat.create');
    }

    /**
     * Simpan perawat oleh Super Admin
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
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        MasterPerawat::create($validated);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan.');
    }

    /**
     * Detail perawat Super Admin
     */
    public function show(MasterPerawat $master_perawat)
    {
        return view('master-perawat.show', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Form edit Super Admin
     */
    public function edit(MasterPerawat $master_perawat)
    {
        return view('master-perawat.edit', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Update perawat Super Admin
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
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $master_perawat->update($validated);

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    /**
     * Hapus perawat Super Admin
     */
    public function destroy(MasterPerawat $master_perawat)
    {
        $master_perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }


    /*
    |--------------------------------------------------------------------------
    | KHUSUS ADMIN RUMAH SAKIT
    |--------------------------------------------------------------------------
    */

    /**
     * Halaman perawat Admin RS
     */
    public function indexAdmin()
{
    return view('admin.data-perawat');
}

    /**
     * DataTables Admin RS
     */
public function dataAdmin()
{
    $perawats = MasterPerawat::query()
        ->orderBy('id', 'desc');

    return DataTables::of($perawats)
        ->addIndexColumn()

        // Data asli untuk modal detail
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

        // Format jenis kelamin di tabel
        ->editColumn('jenis_kelamin', function ($perawat) {
            $gender = strtolower($perawat->jenis_kelamin ?? '');

            if ($gender === 'laki-laki' || $gender === 'laki_laki') {
                return 'Laki-laki';
            }

            if ($gender === 'perempuan') {
                return 'Perempuan';
            }

            return '-';
        })

        // Format tanggal lahir di tabel
        ->editColumn('tanggal_lahir', function ($perawat) {
            return $perawat->tanggal_lahir
                ? Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y')
                : '-';
        })

        // Alamat
        ->editColumn('alamat', function ($perawat) {
            return $perawat->alamat ?: '-';
        })

        ->make(true);
}


    /**
     * Tambah perawat oleh Admin RS
     */
    public function storeAdmin(Request $request)
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
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        MasterPerawat::create($validated);

        return redirect()
            ->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil ditambahkan.');
    }

    /**
     * Update perawat oleh Admin RS
     */
    public function updateAdmin(Request $request, string $id)
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
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $perawat = MasterPerawat::findOrFail($id);
        $perawat->update($validated);

        return redirect()
            ->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    /**
     * Hapus perawat oleh Admin RS
     */
    public function destroyAdmin(string $id)
    {
        $perawat = MasterPerawat::findOrFail($id);
        $perawat->delete();

        return redirect()
            ->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }
}
