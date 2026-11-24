<?php

namespace App\Http\Controllers;

use App\Models\MasterSupplier;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MasterSupplierController extends Controller
{
    /**
     * =========================================================
     * HALAMAN MASTER SUPPLIER
     * =========================================================
     */
    public function index()
    {
        return view('master-supplier.index');
    }


    /**
     * =========================================================
     * DATA YAJRA DATATABLES
     * =========================================================
     */
    public function data()
{
    $suppliers = MasterSupplier::select('id', 'nama');

    return DataTables::of($suppliers)
        ->addIndexColumn()
       ->addColumn('aksi', function ($supplier) {

    return '
        <button class="btn btn-info btn-sm btn-lihat">
            Lihat
        </button>

        <button class="btn btn-warning btn-sm btn-edit">
            Edit
        </button>

        <button
            class="btn btn-danger btn-sm btn-hapus-supplier"
            data-url="'.route('master-supplier.destroy', $supplier->id).'"
        >
            Hapus
        </button>
    ';
})
        ->rawColumns(['aksi'])
        ->make(true);
}

    /**
     * =========================================================
     * CREATE
     * =========================================================
     *
     * Sebenarnya halaman create tidak kita gunakan karena
     * tambah supplier akan menggunakan modal.
     */
    public function create()
    {
        return view('master-supplier.create');
    }


    /**
     * =========================================================
     * SIMPAN SUPPLIER
     * =========================================================
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    $supplier = MasterSupplier::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Supplier berhasil ditambahkan.',
        'data' => $supplier,
    ], 201);
}

    /**
     * =========================================================
     * SHOW
     * =========================================================
     *
     * Route ini tetap tersedia dari Route::resource.
     * Pada tampilan DataTables nanti tombol Lihat menggunakan
     * modal sehingga tidak perlu pindah halaman.
     */
    public function show(MasterSupplier $masterSupplier)
    {
        return view(
            'master-supplier.show',
            compact('masterSupplier')
        );
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     *
     * Route ini juga tetap tersedia.
     * Tampilan utama nanti menggunakan modal edit.
     */
    public function edit(MasterSupplier $masterSupplier)
    {
        return view(
            'master-supplier.edit',
            compact('masterSupplier')
        );
    }


    /**
     * =========================================================
     * UPDATE SUPPLIER
     * =========================================================
     */
    public function update(Request $request, MasterSupplier $masterSupplier)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    $masterSupplier->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Supplier berhasil diperbarui.',
    ]);
}
    /**
     * =========================================================
     * HAPUS SUPPLIER
     * =========================================================
     */
    public function destroy(MasterSupplier $masterSupplier)
    {
        try {

            $masterSupplier->delete();


            return response()->json([
                'success' => true,
                'message' => 'Data supplier berhasil dihapus.'
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {

            /**
             * Supplier masih dipakai oleh tabel lain
             */
            if ($e->getCode() == '23000') {

                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak bisa dihapus karena masih digunakan pada data lain.'
                ], 422);
            }


            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data dari database.'
            ], 500);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // ==================================================
// HALAMAN SUPPLIER OBAT KHUSUS APOTEKER
// ==================================================
public function indexApoteker()
{
    $suppliers = \App\Models\MasterSupplier::orderBy('nama', 'asc')
        ->paginate(10);

    return view('apoteker.supplier-obat', compact('suppliers'));
}

// HALAMAN SUPPLIER KHUSUS ADMIN
public function indexAdmin()
{
    $suppliers = MasterSupplier::orderBy('nama', 'asc')->get();

    return view('admin.data-apoteker.supplier-obat', compact('suppliers'));
}

// ==================================================
// DATA SUPPLIER KHUSUS APOTEKER
// ==================================================
public function dataApoteker()
{
    $suppliers = MasterSupplier::query()
        ->select([
            'id',
            'kode',
            'nama',
            'created_at',
        ])
        ->orderBy('nama', 'asc')
        ->get();

    return response()->json([
        'data' => $suppliers
    ]);
}
}
