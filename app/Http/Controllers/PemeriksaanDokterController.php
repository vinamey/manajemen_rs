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
    public function index()
    {
        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->latest()->paginate(10);

        $pendaftarans = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])
        ->whereDoesntHave('pemeriksaan')
        ->whereNotNull('dokter_id')
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => [
                'required',
                'exists:pendaftaran_pasiens,id',
            ],
            'keluhan' => [
                'required',
                'string',
            ],
            'resep_obat' => [
                'nullable',
                'json',
            ],
        ]);

        // Ambil data pendaftaran beserta dokter yang terdaftar.
        $pendaftaran = PendaftaranPasien::with(['pasien', 'dokter', 'poli'])
            ->findOrFail($validated['pendaftaran_id']);

        // Dokter otomatis mengikuti data pendaftaran.
        if (!$pendaftaran->dokter_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'pendaftaran_id' => 'Pendaftaran ini belum memiliki dokter.',
                ]);
        }

        $obatList = json_decode($request->input('resep_obat', '[]'), true);

        if (!is_array($obatList)) {
            return back()
                ->withInput()
                ->withErrors([
                    'resep_obat' => 'Format daftar resep obat tidak valid.',
                ]);
        }

        DB::transaction(function () use ($validated, $pendaftaran, $obatList) {
            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $pendaftaran->id,
                'dokter_id'      => $pendaftaran->dokter_id,
                'keluhan'        => $validated['keluhan'],
                'resep_obat'     => 0,
            ]);

            $obatValid = [];

            foreach ($obatList as $obat) {
                if (
                    !is_array($obat) ||
                    empty($obat['obat_id']) ||
                    !isset($obat['jumlah']) ||
                    !is_numeric($obat['jumlah']) ||
                    (int) $obat['jumlah'] < 1
                ) {
                    continue;
                }

                $obatValid[] = $obat;
            }

            if (count($obatValid) === 0) {
                return;
            }

            $resep = ResepObat::create([
                'pemeriksaan_id' => $pemeriksaan->id,
            ]);

            foreach ($obatValid as $obat) {
                $aturan = [];

                if (!empty($obat['dosis'])) {
                    $aturan[] = 'Dosis: ' . $obat['dosis'];
                }

                if (!empty($obat['frekuensi'])) {
                    $aturan[] = 'Frekuensi: ' . $obat['frekuensi'];
                }

                if (!empty($obat['aturan_pakai'])) {
                    $aturan[] = 'Aturan: ' . $obat['aturan_pakai'];
                }

                if (!empty($obat['lama'])) {
                    $aturan[] = 'Lama: ' . $obat['lama'] . ' hari';
                }

                $resep->obat()->attach(
                    (int) $obat['obat_id'],
                    [
                        'satuan_obat_id' => null,
                        'nilai'          => (int) $obat['jumlah'],
                        'aturan_pakai'   => implode(' | ', $aturan) ?: '-',
                    ]
                );
            }
        });

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
    }

    public function show($id)
    {
        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->findOrFail($id);

        return view('pemeriksaan-dokter.show', compact('pemeriksaan'));
    }

    public function edit($id)
    {
        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->findOrFail($id);

        $pendaftarans = PendaftaranPasien::with('pasien')
            ->whereDoesntHave('pemeriksaan')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama', 'ASC')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

        return view('pemeriksaan-dokter.edit', compact(
            'pemeriksaan',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id'      => 'required|exists:master_dokters,id',
            'keluhan'        => 'required|string',
        ]);

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        $pemeriksaan->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id'      => $request->dokter_id,
            'keluhan'        => $request->keluhan,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        DB::transaction(function () use ($pemeriksaan) {
            $resep = ResepObat::where(
                'pemeriksaan_id',
                $pemeriksaan->id
            )->first();

            if ($resep) {
                $resep->obat()->detach();
                $resep->delete();
            }

            $pemeriksaan->delete();
        });

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}