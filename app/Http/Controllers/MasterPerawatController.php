<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * Halaman Master Perawat Superadmin
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

            ->editColumn('tanggal_lahir', function ($perawat) {
                return $perawat->tanggal_lahir
                    ? Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })

            ->editColumn('alamat', function ($perawat) {
                return $perawat->alamat
                    ? e($perawat->alamat)
                    : '-';
            })

            ->addColumn('aksi', function ($perawat) {
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
     * Form tambah Superadmin
     */
    public function create()
    {
        return view('master-perawat.create');
    }

    /**
     * Tambah perawat sekaligus membuat akun login
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

            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',

            'email.required' => 'Email login wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        DB::transaction(function () use ($validated) {

            // 1. Membuat akun login perawat
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // 2. Memberikan role perawat
            $user->assignRole('perawat');

            // 3. Membuat data master perawat
            $perawat = MasterPerawat::create([
                'users_id' => $user->id,
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
            ]);

            // 4. Menghubungkan kembali users ke master perawat
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'perawat_id' => $perawat->id,
                ]);
        });

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat dan akun login berhasil dibuat.');
    }

    /**
     * Detail perawat Superadmin
     */
    public function show(MasterPerawat $master_perawat)
    {
        return view('master-perawat.show', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Form edit Superadmin
     */
    public function edit(MasterPerawat $master_perawat)
    {
        return view('master-perawat.edit', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Update perawat Superadmin
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

        DB::transaction(function () use ($master_perawat, $validated) {

            $master_perawat->update($validated);

            // Sinkronisasi nama akun login
            if ($master_perawat->user) {
                $master_perawat->user->update([
                    'name' => $validated['nama'],
                ]);
            }
        });

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    /**
     * Hapus perawat Superadmin
     */
    public function destroy(MasterPerawat $master_perawat)
    {
        // Menghapus data master saja.
        // Akun users tidak ikut dihapus.
        $master_perawat->delete();

        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN RUMAH SAKIT
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

            ->editColumn('tanggal_lahir', function ($perawat) {
                return $perawat->tanggal_lahir
                    ? Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y')
                    : '-';
            })

            ->editColumn('alamat', function ($perawat) {
                return $perawat->alamat ?: '-';
            })

            ->make(true);
    }

    /**
     * Tambah perawat oleh Admin RS sekaligus membuat akun login
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

            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',

            'email.required' => 'Email login wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

       DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            $user->assignRole('perawat');

            $perawat = MasterPerawat::create([
                'users_id' => $user->id,
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
            ]);

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'perawat_id' => $perawat->id,
                ]);
        });

        return redirect()
            ->route('admin.perawat.index')
            ->with('success', 'Data perawat dan akun login berhasil dibuat.');
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

        DB::transaction(function () use ($perawat, $validated) {

            $perawat->update($validated);

            if ($perawat->user) {
                $perawat->user->update([
                    'name' => $validated['nama'],
                ]);
            }
        });

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

        // Akun users tidak ikut dihapus
        $perawat->delete();

        return redirect()
            ->route('admin.perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }
}