<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\ResepObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanDokterController extends Controller
{
    /**
     * Menampilkan halaman pemeriksaan dokter
     */
    public function index()
    {
        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'obat'
        ])
        ->latest()
        ->paginate(10);

        $pendaftarans = PendaftaranPasien::with('pasien')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama', 'ASC')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

       return view('pemeriksaan-dokter.index', compact(
            'pemeriksaans',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    /**
     * Menyimpan pemeriksaan + resep obat
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id'      => 'required|exists:master_dokters,id',
            'keluhan'        => 'nullable|string',
            'resep_obat'     => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | 1. Simpan pemeriksaan dokter
            |--------------------------------------------------------------------------
            */

            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $request->pendaftaran_id,
                'dokter_id'      => $request->dokter_id,
                'keluhan'        => $request->keluhan,
            ]);


            /*
            |--------------------------------------------------------------------------
            | 2. Kalau ada resep obat
            |--------------------------------------------------------------------------
            */

            if ($request->filled('resep_obat')) {

                $obatList = json_decode(
                    $request->resep_obat,
                    true
                );

                if (is_array($obatList) && count($obatList) > 0) {

                    /*
                    |--------------------------------------------------------------------------
                    | Buat header resep
                    |--------------------------------------------------------------------------
                    */

                    $resep = ResepObat::create([
                        'pemeriksaan_id' => $pemeriksaan->id,
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Simpan obat ke pivot
                    |--------------------------------------------------------------------------
                    */

                    foreach ($obatList as $obat) {

                        if (
                            empty($obat['obat_id']) ||
                            empty($obat['jumlah'])
                        ) {
                            continue;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Dosis + frekuensi + lama disimpan
                        | ke kolom aturan_pakai karena tabel pivot yang
                        | sudah ada tidak mempunyai kolom tersebut.
                        |--------------------------------------------------------------------------
                        */

                        $aturanPakai = '';

                        if (!empty($obat['dosis'])) {
                            $aturanPakai .= 'Dosis: ' . $obat['dosis'];
                        }

                        if (!empty($obat['frekuensi'])) {

                            if ($aturanPakai !== '') {
                                $aturanPakai .= ' | ';
                            }

                            $aturanPakai .= 'Frekuensi: ' . $obat['frekuensi'];
                        }

                        if (!empty($obat['aturan_pakai'])) {

                            if ($aturanPakai !== '') {
                                $aturanPakai .= ' | ';
                            }

                            $aturanPakai .= 'Aturan: ' . $obat['aturan_pakai'];
                        }

                        if (!empty($obat['lama'])) {

                            if ($aturanPakai !== '') {
                                $aturanPakai .= ' | ';
                            }

                            $aturanPakai .= 'Lama: ' . $obat['lama'] . ' hari';
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Simpan ke pivot
                        |--------------------------------------------------------------------------
                        */

                        $resep->obat()->attach(
                            $obat['obat_id'],
                            [
                                'satuan_obat_id' => null,
                                'nilai'          => $obat['jumlah'],
                                'aturan_pakai'   => $aturanPakai,
                            ]
                        );
                    }
                }
            }
        });

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with(
                'success',
                'Pemeriksaan dan resep obat berhasil disimpan.'
            );
    }

    /**
     * Menampilkan detail pemeriksaan
     */
    public function show($id)
    {
        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'obat',
        ])->findOrFail($id);

        return view(
            'pemeriksaan_dokter.show',
            compact('pemeriksaan')
        );
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        $pendaftarans = PendaftaranPasien::with('pasien')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama', 'ASC')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

        return view(
            'pemeriksaan_dokter.edit',
            compact(
                'pemeriksaan',
                'pendaftarans',
                'dokters',
                'obats'
            )
        );
    }

    /**
     * Update pemeriksaan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id'      => 'required|exists:master_dokters,id',
            'keluhan'        => 'nullable|string',
        ]);

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        $pemeriksaan->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id'      => $request->dokter_id,
            'keluhan'        => $request->keluhan,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with(
                'success',
                'Data pemeriksaan berhasil diperbarui.'
            );
    }

    /**
     * Hapus pemeriksaan
     */
    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        DB::transaction(function () use ($pemeriksaan) {

            /*
            | Hapus resep terlebih dahulu
            */

            $resep = ResepObat::where(
                'pemeriksaan_id',
                $pemeriksaan->id
            )->first();

            if ($resep) {

                /*
                | Hapus data pivot
                */

                $resep->obat()->detach();

                /*
                | Hapus header resep
                */

                $resep->delete();
            }

            /*
            | Hapus pemeriksaan
            */

            $pemeriksaan->delete();
        });

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with(
                'success',
                'Data pemeriksaan berhasil dihapus.'
            );
    }
}
