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
        $suppliers = MasterSupplier::query()
            ->select([
                'id',
                'kode',
                'nama',
                'created_at',
                'updated_at'
            ]);

        return DataTables::of($suppliers)

            /**
             * Nomor urut DataTables
             */
            ->addIndexColumn()

            /**
             * Kolom aksi
             */
            ->addColumn('aksi', function ($supplier) {

                $updateUrl = route(
                    'master-supplier.update',
                    $supplier->id
                );

                $deleteUrl = route(
                    'master-supplier.destroy',
                    $supplier->id
                );

                return '
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn-aksi btn-lihat"
                            data-id="' . $supplier->id . '"
                            data-kode="' . e($supplier->kode) . '"
                            data-nama="' . e($supplier->nama) . '"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>


                        <button
                            type="button"
                            class="btn-aksi btn-edit"
                            data-id="' . $supplier->id . '"
                            data-kode="' . e($supplier->kode) . '"
                            data-nama="' . e($supplier->nama) . '"
                            data-url="' . $updateUrl . '"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </button>


                        <button
                            type="button"
                            class="btn-aksi btn-hapus btn-hapus-supplier"
                            data-id="' . $supplier->id . '"
                            data-nama="' . e($supplier->nama) . '"
                            data-url="' . $deleteUrl . '"
                            title="Hapus"
                        >
                            <i class="fas fa-trash"></i>
                            <span>Hapus</span>
                        </button>

                    </div>
                ';
            })

            /**
             * Izinkan HTML pada kolom aksi
             */
            ->rawColumns([
                'aksi'
            ])

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
        try {

            $validated = $request->validate([
                'kode' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:master_suppliers,kode'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);


            $supplier = MasterSupplier::create([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Data supplier berhasil ditambahkan.',
                'data' => $supplier
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
    public function update(
        Request $request,
        MasterSupplier $masterSupplier
    ) {
        try {

            $validated = $request->validate([
                'kode' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:master_suppliers,kode,' . $masterSupplier->id
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);


            $masterSupplier->update([
                'kode' => $validated['kode'],
                'nama' => $validated['nama'],
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Data supplier berhasil diperbarui.'
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
