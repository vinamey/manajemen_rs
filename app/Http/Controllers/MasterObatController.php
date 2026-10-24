<?php

namespace App\Http\Controllers;

use App\Models\MasterObat;
use App\Models\MasterKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterObatController extends Controller
{
    // =========================================================
    // HALAMAN MASTER OBAT
    // =========================================================
    public function index()
    {
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();

        return view('master-obat.index', compact('kategoris'));
    }


    // =========================================================
    // DATA YAJRA DATATABLE
    // =========================================================
    public function data()
    {
        $obats = MasterObat::with('kategori')
            ->select('master_obats.*')
            ->orderBy('id', 'desc');

        return DataTables::of($obats)

            // Nomor urut
            ->addIndexColumn()

            // Nama kategori
            ->addColumn('kategori_nama', function ($obat) {
                return $obat->kategori
                    ? $obat->kategori->nama
                    : '-';
            })

            // Tombol aksi
            ->addColumn('aksi', function ($obat) {

                $deleteUrl = route(
                    'master-obat.destroy',
                    $obat->id
                );

                return '
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn-aksi btn-lihat"
                            title="Lihat"
                        >
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>

                        <button
                            type="button"
                            class="btn-aksi btn-edit"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </button>

                        <form
                            action="' . $deleteUrl . '"
                            method="POST"
                            onsubmit="return confirm(\'Yakin ingin menghapus obat ini?\')"
                        >
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '

                            <button
                                type="submit"
                                class="btn-aksi btn-hapus"
                                title="Hapus"
                            >
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </button>

                        </form>

                    </div>
                ';
            })

            ->rawColumns([
                'aksi'
            ])

            ->make(true);
    }


    // =========================================================
    // SIMPAN OBAT
    // =========================================================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:master_kategoris,id',
        ]);

        MasterObat::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()
            ->route('master-obat.index')
            ->with(
                'success',
                'Data obat berhasil ditambahkan.'
            );
    }


    // =========================================================
    // DETAIL OBAT
    // =========================================================
    public function show(string $id)
    {
        $obat = MasterObat::with('kategori')
            ->findOrFail($id);

        return view(
            'master-obat.show',
            compact('obat')
        );
    }


    // =========================================================
    // UPDATE OBAT
    // =========================================================
    public function update(Request $request, string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:master_kategoris,id',
        ]);

        $obat->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()
            ->route('master-obat.index')
            ->with(
                'success',
                'Data obat berhasil diperbarui.'
            );
    }
public function indexApoteker()
{
    $kategoris = MasterKategori::orderBy('nama', 'asc')->get();

    return view('apoteker.master-obat.index', compact('kategoris'));
}

    // =========================================================
    // HAPUS OBAT
    // =========================================================
    public function destroy(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $obat->delete();

        return redirect()
            ->route('master-obat.index')
            ->with(
                'success',
                'Data obat berhasil dihapus.'
            );
    }
}
