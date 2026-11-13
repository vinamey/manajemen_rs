<?php

namespace App\Http\Controllers;

use App\Models\MasterObat;
use App\Models\MasterKategori;
use App\Models\MasterSatuanObat;
use App\Models\HargaJualObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MasterObatController extends Controller
{
    // HALAMAN MASTER OBAT
    public function index()
    {
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();

        return view('master-obat.index', compact('kategoris'));
    }

    // DATA MASTER OBAT
    public function data()
    {
        $obats = MasterObat::with('kategori')
            ->select('master_obats.*')
            ->orderBy('id', 'desc');

        return DataTables::of($obats)
            ->addIndexColumn()
            ->addColumn('kategori_nama', function ($obat) {
                return $obat->kategori?->nama ?? '-';
            })
            ->addColumn('aksi', function ($obat) {
                $deleteUrl = route('master-obat.destroy', $obat->id);

                return '
                    <div class="action-buttons">
                        <button type="button"
                            class="btn-aksi btn-lihat"
                            title="Lihat">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>

                        <button type="button"
                            class="btn-aksi btn-edit"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </button>

                        <form action="' . $deleteUrl . '"
                            method="POST"
                            onsubmit="return confirm(\'Yakin ingin menghapus obat ini?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '

                            <button type="submit"
                                class="btn-aksi btn-hapus"
                                title="Hapus">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // FORM TAMBAH OBAT
    public function create()
    {
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();

        return view('apoteker.tambah-obat', compact('kategoris'));
    }

    // SIMPAN OBAT
    public function store(Request $request)
    {
        // Penyimpanan dari halaman Data Obat Apoteker
        if ($request->routeIs('apoteker.obat.store')) {

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'kategori_id' => 'required|exists:master_kategoris,id',
                'satuan_id' => 'required|exists:master_satuan_obats,id',
                'isi' => 'required|integer|min:1',
                'harga' => 'required|numeric|min:0',
            ]);

            DB::transaction(function () use ($validated) {
                $obat = MasterObat::create([
                    'nama' => $validated['nama'],
                    'kategori_id' => $validated['kategori_id'],
                ]);

                HargaJualObat::create([
                    'obat_id' => $obat->id,
                    'satuan_id' => $validated['satuan_id'],
                    'isi' => $validated['isi'],
                    'harga' => $validated['harga'],
                ]);
            });

            return redirect()
                ->route('apoteker.obat.index')
                ->with('success', 'Data obat dan harga jual berhasil ditambahkan.');
        }

        // Penyimpanan dari halaman Master Obat tetap seperti sebelumnya
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:master_kategoris,id',
        ]);

        MasterObat::create([
            'nama' => $validated['nama'],
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    // DETAIL OBAT
    public function show(string $id)
    {
        $obat = MasterObat::with('kategori')->findOrFail($id);

        return view('master-obat.show', compact('obat'));
    }

    // UPDATE OBAT
    public function update(Request $request, string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:master_kategoris,id',
        ]);

        $obat->update([
            'nama' => $validated['nama'],
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    // HALAMAN DATA OBAT APOTEKER
    public function indexApoteker()
    {
        $kategoris = MasterKategori::orderBy('nama', 'asc')->get();

        $satuans = MasterSatuanObat::orderBy('nama', 'asc')->get();

        $obats = MasterObat::orderBy('nama', 'asc')->get();

        return view(
            'apoteker.data-obat',
            compact('kategoris', 'satuans', 'obats')
        );
    }

    
// DATA YAJRA APOTEKER
public function dataApoteker()
{
    // Mengambil data konfigurasi obat dari tabel harga_jual_obats
    $hargaObats = HargaJualObat::with([
        'obat.kategori',
        'satuan'
    ])
    ->select('harga_jual_obats.*')
    ->orderBy('id', 'desc');

    // Menampilkan data menggunakan Yajra DataTables
    return DataTables::of($hargaObats)
        ->addIndexColumn()

        // Nama obat dari Master Obat
        ->addColumn('nama', function ($hargaObat) {
            return $hargaObat->obat?->nama ?? '-';
        })

        // Kategori obat
        ->addColumn('kategori_nama', function ($hargaObat) {
            return $hargaObat->obat?->kategori?->nama ?? '-';
        })

        // Nama satuan obat
        ->addColumn('satuan_nama', function ($hargaObat) {
            return $hargaObat->satuan?->nama ?? '-';
        })

        // Isi kemasan
        ->addColumn('isi', function ($hargaObat) {
            return $hargaObat->isi ?? '-';
        })

        // Harga jual
        ->addColumn('harga', function ($hargaObat) {
            $harga = $hargaObat->harga;

            return $harga !== null
                ? 'Rp ' . number_format((float) $harga, 0, ',', '.')
                : '-';
        })

        ->make(true);
}


    // SIMPAN SATUAN DAN HARGA JUAL OBAT YANG SUDAH ADA
public function storeHarga(Request $request)
{
    $validated = $request->validate([
        'obat_id' => 'required|exists:master_obats,id',
        'satuan_id' => 'required|exists:master_satuan_obats,id',
        'isi' => 'required|integer|min:1',
        'harga' => 'required|numeric|min:1',
    ]);

    // Cek apakah obat sudah memiliki konfigurasi satuan tersebut
    $sudahAda = HargaJualObat::where('obat_id', $validated['obat_id'])
        ->where('satuan_id', $validated['satuan_id'])
        ->exists();

    if ($sudahAda) {
        return redirect()->back()
            ->withErrors([
                'satuan_id' => 'Satuan untuk obat ini sudah terdaftar.'
            ])
            ->withInput();
    }

    DB::transaction(function () use ($validated) {
        HargaJualObat::create([
            'obat_id' => $validated['obat_id'],
            'satuan_id' => $validated['satuan_id'],
            'isi' => $validated['isi'],
            'harga' => $validated['harga'],
        ]);
    });

    return redirect()
        ->route('apoteker.obat.index')
        ->with('success', 'Satuan dan harga jual obat berhasil ditambahkan.');
}

    // HAPUS OBAT
    public function destroy(string $id)
    {
        $obat = MasterObat::findOrFail($id);

        $obat->delete();

        return redirect()
            ->route('master-obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}