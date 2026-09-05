<?php

namespace App\Http\Controllers;

use App\Models\MasterSupplier;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MasterSupplierController extends Controller
{
    public function index()
    {
        $suppliers = MasterSupplier::latest()->get();

        return view('master-supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('master-supplier.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode' => 'required|string|max:50|unique:master_suppliers,kode',
                'nama' => 'required|string|max:255',
            ]);

            $supplier = MasterSupplier::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data supplier berhasil ditambahkan.',
                'data'    => $supplier
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(MasterSupplier $masterSupplier)
    {
        return view('master-supplier.show', compact('masterSupplier'));
    }

    public function edit(MasterSupplier $masterSupplier)
    {
        return view('master-supplier.edit', compact('masterSupplier'));
    }

   public function update(Request $request, MasterSupplier $masterSupplier)
{
    try {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:master_suppliers,kode,' . $masterSupplier->id,
            'nama' => 'required|string|max:255',
        ]);

        $masterSupplier->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data supplier berhasil diperbarui.'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal.',
            'errors'  => $e->errors()
        ], 422);

    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
   public function destroy(MasterSupplier $masterSupplier)
{
    try {
        $masterSupplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data supplier berhasil dihapus.'
        ]);

    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == "23000") {
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
}