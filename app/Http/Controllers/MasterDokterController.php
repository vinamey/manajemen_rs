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
                if ($jk === 'laki-laki' || $jk === 'laki_laki' || $jk === 'l') {
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

                return Carbon::parse($dokter->tanggal_lahir)->format('d-m-Y');
            })
            ->editColumn('spesialis', function ($dokter) {
                return $dokter->spesialis ? e($dokter->spesialis) : '-';
            })
            ->addColumn('poli_nama', function ($dokter) {
                return $dokter->poli ? e($dokter->poli->nama) : '-';
            })
            ->editColumn('alamat', function ($dokter) {
                return $dokter->alamat ? e($dokter->alamat) : '-';
            })
            ->addColumn('aksi', function ($dokter) {
                return '
                    <div class="action-buttons">
                        <button type="button" class="btn-action btn-view" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn-action btn-delete" data-id="' . $dokter->id . '" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['jenis_kelamin', 'aksi'])
            ->make(true);
    }

    /**
     * Form tambah lama
     */
    public function create()
    {
        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.create', compact('polis'));
    }

    /**
     * Simpan dokter
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (disesuaikan agar menerima format laki_laki/laki-laki & tabel poli yang dinamis)
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis'     => 'nullable|string|max:255',
            'alamat'        => 'nullable|string',
            'poli_id'       => 'required|exists:' . (new MasterPoli())->getTable() . ',id',
        ]);

        // 2. Simpan Ke Database
        $dokter = MasterDokter::create($validated);

        // 3. Return Response AJAX / Standard Redirect
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status'  => 'success',
                'message' => 'Data dokter berhasil ditambahkan.',
                'data'    => $dokter,
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    /**
     * Detail dokter
     */
    public function show(Request $request, string $id)
    {
        $dokter = MasterDokter::with('poli')->findOrFail($id);

        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $dokter,
            ], 200);
        }

        return view('master-dokter.show', compact('dokter'));
    }

    /**
     * Edit dokter
     */
    public function edit(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $dokter,
            ], 200);
        }

        $polis = MasterPoli::orderBy('nama', 'asc')->get();

        return view('master-dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update dokter
     */
    public function update(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis'     => 'nullable|string|max:255',
            'alamat'        => 'nullable|string',
            'poli_id'       => 'required|exists:' . (new MasterPoli())->getTable() . ',id',
        ]);

        $dokter->update($validated);

        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status'  => 'success',
                'message' => 'Data dokter berhasil diperbarui.',
                'data'    => $dokter->fresh(),
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Hapus dokter
     */
    public function destroy(Request $request, string $id)
    {
        $dokter = MasterDokter::findOrFail($id);
        $dokter->delete();

        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status'  => 'success',
                'message' => 'Data dokter berhasil dihapus.',
            ], 200);
        }

        return redirect()
            ->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }




    // HALAMAN DATA DOKTER KHUSUS ADMIN RS
    public function indexAdmin()
{
    $polis = MasterPoli::orderBy('nama', 'asc')->get();

    return view('admin.data-dokter', compact('polis'));
}

    // DATA DOKTER UNTUK DATATABLES ADMIN RS

public function dataAdmin()
{
    $dokters = MasterDokter::with('poli')
        ->select('master_dokters.*')
        ->orderBy('id', 'desc');

    return DataTables::of($dokters)
        ->addIndexColumn()

        ->addColumn('poli_nama', function ($dokter) {
            return $dokter->poli
                ? $dokter->poli->nama
                : '-';
        })

        ->addColumn('spesialis', function ($dokter) {
            return $dokter->spesialis ?: '-';
        })

        ->make(true);
}

    // ==============================
    // TAMBAH DOKTER ADMIN RS
    // ==============================
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,laki_laki',
            'tanggal_lahir' => 'required|date',
            'spesialis' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'poli_id' => 'required|exists:master_polis,id',
        ]);

        MasterDokter::create($validated);

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    // ==============================
    // EDIT DOKTER ADMIN RS
    // ==============================
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

        $dokter->update($validated);

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    // ==============================
    // HAPUS DOKTER ADMIN RS
    // ==============================
    public function destroyAdmin(string $id)
    {
        $dokter = MasterDokter::findOrFail($id);

        $dokter->delete();

        return redirect()
            ->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }

}
