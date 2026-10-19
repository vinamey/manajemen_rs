
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
    // HALAMAN PEMERIKSAAN LAMA
    public function index()
    {
        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->latest()->paginate(10);

        $pendaftarans = PendaftaranPasien::with([
            'pasien', 'dokter', 'poli',
        ])
            ->whereDoesntHave('pemeriksaan')
            ->whereNotNull('dokter_id')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama')
            ->get();

        return view('pemeriksaan-dokter.index', compact(
            'pemeriksaans',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    // HALAMAN KHUSUS DOKTER
    public function indexDokter()
    {
        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->latest()->paginate(10);

        $pendaftarans = PendaftaranPasien::with([
            'pasien', 'dokter', 'poli',
        ])
            ->whereDoesntHave('pemeriksaan')
            ->whereNotNull('dokter_id')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama')
            ->get();

        return view('dokter.pemeriksaan.index', compact(
            'pemeriksaans',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    // SIMPAN PEMERIKSAAN DAN RESEP
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => [
                'required',
                'exists:pendaftaran_pasiens,id',
            ],
            'keluhan' => ['required', 'string'],
            'resep_obat' => ['nullable', 'json'],
        ]);

        $pendaftaran = PendaftaranPasien::with([
            'pasien', 'dokter', 'poli',
        ])->findOrFail($validated['pendaftaran_id']);

        if (!$pendaftaran->dokter_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'pendaftaran_id' =>
                        'Pendaftaran ini belum memiliki dokter.',
                ]);
        }

        // Dokter hanya boleh menyimpan pemeriksaan sesuai dokter
        // yang ditetapkan pada pendaftaran pasien.
        if (
            auth()->user()->hasRole('dokter')
            && !auth()->user()->hasRole('super admin')
        ) {
            $dokterLogin = \App\Models\MasterDokter::where(
                'email',
                auth()->user()->email
            )->first();

            if (
                !$dokterLogin
                || (int) $pendaftaran->dokter_id !== (int) $dokterLogin->id
            ) {
                abort(403, 'Pendaftaran ini bukan tanggung jawab dokter Anda.');
            }
        }

        $obatList = json_decode(
            $request->input('resep_obat', '[]'),
            true
        );

        if (!is_array($obatList)) {
            return back()
                ->withInput()
                ->withErrors([
                    'resep_obat' => 'Format daftar resep obat tidak valid.',
                ]);
        }

        DB::transaction(function () use (
            $validated,
            $pendaftaran,
            $obatList
        ) {
            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $pendaftaran->id,
                'dokter_id' => $pendaftaran->dokter_id,
                'keluhan' => $validated['keluhan'],
                'resep_obat' => 0,
            ]);

            $obatValid = [];

            foreach ($obatList as $obat) {
                if (
                    !is_array($obat)
                    || empty($obat['obat_id'])
                    || !isset($obat['jumlah'])
                    || !is_numeric($obat['jumlah'])
                    || (int) $obat['jumlah'] < 1
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
                        'nilai' => (int) $obat['jumlah'],
                        'aturan_pakai' => implode(' | ', $aturan) ?: '-',
                    ]
                );
            }
        });

        if (auth()->user()->hasRole('dokter')) {
            return redirect()
                ->route('dokter.pemeriksaan.index')
                ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
        }

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
    }

    // LIHAT PEMERIKSAAN
    public function show($id)
    {
        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->findOrFail($id);

        return view('pemeriksaan-dokter.show', compact('pemeriksaan'));
    }

    // EDIT PEMERIKSAAN LAMA
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

        $dokters = MasterDokter::orderBy('nama')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama')
            ->get();

        return view('pemeriksaan-dokter.edit', compact(
            'pemeriksaan',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    // UPDATE PEMERIKSAAN LAMA
    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id' => 'required|exists:master_dokters,id',
            'keluhan' => 'required|string',
        ]);

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        $pemeriksaan->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    // HAPUS PEMERIKSAAN LAMA
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
