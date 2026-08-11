<?php

namespace App\Http\Controllers;

use App\Models\MasterSupplier;
use Illuminate\Http\Request;

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
        $request->validate([
            'kode_supplier' => 'required|string|max:50|unique:master_suppliers,kode_supplier',
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        MasterSupplier::create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('master-supplier.index')
            ->with('success', 'Data supplier berhasil ditambahkan.');
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
        $request->validate([
            'kode_supplier' => 'required|string|max:50|unique:master_suppliers,kode_supplier,' . $masterSupplier->id,
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $masterSupplier->update([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('master-supplier.index')
            ->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy(MasterSupplier $masterSupplier)
    {
        $masterSupplier->delete();

        return redirect()
            ->route('master-supplier.index')
            ->with('success', 'Data supplier berhasil dihapus.');
    }
}