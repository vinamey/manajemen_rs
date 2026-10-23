<?php

namespace App\Http\Controllers;

use App\Models\MasterKategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class MasterKategoriController extends Controller
{
    public function index()
    {
        return view('master-kategori.index');
    }

    // Mengambil data untuk DataTables
    public function data()
    {
        $kategori = MasterKategori::query()
            ->select(['id', 'kode', 'nama']);

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($item) {
                return '
                    <div class="aksi-wrapper">
                        <button type="button"
                            class="btn-aksi-kategori btn-lihat-kategori">
                            <i class="fas fa-eye"></i>
                        </button>

                        <button type="button"
                            class="btn-aksi-kategori btn-edit-kategori">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button"
                            class="btn-aksi-kategori btn-hapus-kategori"
                            data-url="' . url('/master-kategori/' . $item->id) . '">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Tambah kategori
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:master_kategoris,kode',
            'nama' => 'required|string|max:255',
        ]);

        $kategori = MasterKategori::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $kategori,
        ]);
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $kategori = MasterKategori::findOrFail($id);

        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:50',
                Rule::unique('master_kategoris', 'kode')->ignore($kategori->id),
            ],
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui.',
        ]);
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = MasterKategori::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}
