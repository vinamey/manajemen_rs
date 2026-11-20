<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPoli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class MasterDokterController extends Controller
{
    /**
     * HALAMAN MASTER DOKTER
     */
    public function index()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.index', compact('polis'));
    }

    /**
     * DATA DOKTER UNTUK YAJRA DATATABLES
     */
    public function data()
    {
        $dokters = MasterDokter::with(['poli', 'user'])
            ->select('master_dokters.*')
            ->orderBy('id', 'desc');

        return DataTables::of($dokters)
            ->addIndexColumn()

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

            ->editColumn('jenis_kelamin', function ($dokter) {
                $jk = strtolower($dokter->jenis_kelamin);

                if (
                    $jk === 'laki-laki' ||
                    $jk === 'laki_laki' ||
                    $jk === 'l'
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

            ->editColumn('tanggal_lahir', function ($dokter) {
                if (!$dokter->tanggal_lahir) {
                    return '-';
                }

                return Carbon::parse($dokter->tanggal_lahir)
                    ->format('d-m-Y');
            })

            ->editColumn('spesialis', function ($dokter) {
                return $dokter->spesialis
                    ? e($dokter->spesialis)
                    : '-';
            })

            ->addColumn('poli_nama', function ($dokter) {
                return $dokter->poli
                    ? e($dokter->poli->nama)
                    : '-';
            })

            ->editColumn('alamat', function ($dokter) {
                return $dokter->alamat
                    ? e($dokter->alamat)
                    : '-';
            })

            ->addColumn('aksi', function ($dokter) {
                return '
                    <div class="action-buttons">

                        <button type="button"
                            class="btn-action btn-view"
                            title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>

                        <button type="button"
                            class="btn-action btn-edit"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button"
                            class="btn-action btn-delete"
                            data-id="' . $dokter->id . '"
                            title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>

                    </div>
                ';
            })

            ->rawColumns(['jenis_kelamin', 'aksi'])
            ->make(true);
    }

    /**
     * FORM TAMBAH DOKTER
     */
    public function create()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.create', compact('polis'));
    }

    /**
     * SIMPAN DOKTER SEKALIGUS MEMBUAT AKUN LOGIN
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Data dokter
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'required|exists:master_polis,id',

            // Data akun login
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $dokter = DB::transaction(function () use ($validated) {

            // 1. Membuat akun user
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // 2. Memberikan role dokter
            $user->assignRole('dokter');

            // 3. Membuat data master dokter
            $dokter = MasterDokter::create([
                'nama' => $validated['nama'],
                'users_id' => $user->id,
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'spesialis' => $validated['spesialis'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'poli_id' => $validated['poli_id'],
            ]);

            // 4. Mengisi dokter_id pada tabel users
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'dokter_id' => $dokter->id,
                ]);

            return $dokter;
        });

        // Response AJAX
        if (
            $request->ajax() ||
            $request->wantsJson() ||
            $request->expectsJson()
        ) {
            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Data dokter dan akun login berhasil dibuat.',
                'data' => $dokter,
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter dan akun login berhasil dibuat.');
    }

    /**
     * DETAIL DOKTER
     */
    public function show(Request $request, string $id)
    {
        $dokter = MasterDokter::with(['poli', 'user'])
            ->findOrFail($id);

        if (
            $request->ajax() ||
            $request->wantsJson() ||
            $request->expectsJson()
        ) {
            return response()->json([
                'success' => true,
                'data' => $dokter,
            ], 200);
        }

        return view('master-dokter.show', compact('dokter'));
    }

    /**
     * EDIT DOKTER
     */
    public function edit(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        if (
            $request->ajax() ||
            $request->wantsJson() ||
            $request->expectsJson()
        ) {
            return response()->json([
                'success' => true,
                'data' => $dokter,
            ], 200);
        }

        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * UPDATE DOKTER
     */
    public function update(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'required|exists:master_polis,id',
        ]);

        DB::transaction(function () use ($dokter, $validated) {

            $dokter->update($validated);

            // Sinkronkan nama akun apabila dokter sudah memiliki akun
            if ($dokter->user) {
                $dokter->user->update([
                    'name' => $validated['nama'],
                ]);
            }

            // Pastikan dokter_id pada user tetap sesuai
            if ($dokter->users_id) {
                DB::table('users')
                    ->where('id', $dokter->users_id)
                    ->update([
                        'dokter_id' => $dokter->id,
                    ]);
            }
        });

        if (
            $request->ajax() ||
            $request->wantsJson() ||
            $request->expectsJson()
        ) {
            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Data dokter berhasil diperbarui.',
                'data' => $dokter->fresh(),
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * HAPUS DOKTER
     */
    public function destroy(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        // Hapus data dokter.
        // Akun user tidak dihapus otomatis.
        $dokter->delete();

        if (
            $request->ajax() ||
            $request->wantsJson() ||
            $request->expectsJson()
        ) {
            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Data dokter berhasil dihapus.',
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }

    // ==========================================
    // HALAMAN DATA DOKTER KHUSUS ADMIN RS
    // ==========================================

    public function indexAdmin()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('admin.data-dokter', compact('polis'));
    }

    // ==========================================
    // DATA DOKTER UNTUK DATATABLES ADMIN RS
    // ==========================================

    public function dataAdmin()
    {
        $dokters = MasterDokter::with('poli')
            ->select('master_dokters.*')
            ->orderBy('id', 'desc');

        return DataTables::of($dokters)
            ->addIndexColumn()

            ->addColumn('poli_nama', function ($dokter) {
                return $dokter->poli
                    ? e($dokter->poli->nama)
                    : '-';
            })

            ->addColumn('spesialis', function ($dokter) {
                return $dokter->spesialis ?: '-';
            })

            ->make(true);
    }

    // ==========================================
    // TAMBAH DOKTER ADMIN RS + AKUN LOGIN
    // ==========================================

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            // Data dokter
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'required|exists:master_polis,id',

            // Data akun
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($validated) {

            // 1. Membuat akun user
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // 2. Memberikan role dokter
            $user->assignRole('dokter');

            // 3. Membuat data master dokter
            $dokter = MasterDokter::create([
                'nama' => $validated['nama'],
                'users_id' => $user->id,
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'spesialis' => $validated['spesialis'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'poli_id' => $validated['poli_id'],
            ]);

            // 4. Mengisi dokter_id pada tabel users
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'dokter_id' => $dokter->id,
                ]);
        });

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter dan akun login berhasil dibuat.');
    }

    // ==========================================
    // EDIT DOKTER ADMIN RS
    // ==========================================

    public function updateAdmin(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'required|exists:master_polis,id',
        ]);

        DB::transaction(function () use ($dokter, $validated) {

            $dokter->update($validated);

            // Sinkronkan nama akun
            if ($dokter->user) {
                $dokter->user->update([
                    'name' => $validated['nama'],
                ]);
            }

            // Pastikan dokter_id pada user tetap sesuai
            if ($dokter->users_id) {
                DB::table('users')
                    ->where('id', $dokter->users_id)
                    ->update([
                        'dokter_id' => $dokter->id,
                    ]);
            }
        });

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    // ==========================================
    // HAPUS DOKTER ADMIN RS
    // ==========================================

    public function destroyAdmin(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }
}
