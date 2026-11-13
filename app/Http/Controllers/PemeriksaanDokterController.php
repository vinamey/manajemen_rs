<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\ResepObat;
use App\Models\MasterFrekuensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanDokterController extends Controller
{
    /**
     * Halaman Pemeriksaan Dokter untuk Super Admin.
     */
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

    $stokObats = StokObat::with(['obat', 'satuanObat'])
        ->orderBy('obat_id')
        ->get();

    // Ambil data Master Frekuensi
    $frekuensis = MasterFrekuensi::orderBy('nama', 'ASC')->get();

    return view('pemeriksaan-dokter.index', compact(
        'pemeriksaans',
        'pendaftarans',
        'dokters',
        'obats',
        'stokObats',
        'frekuensis'
    ));
}

    /**
     * Halaman Pemeriksaan Dokter khusus akun Dokter.
     */
    public function indexDokter()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
            ->latest()
            ->paginate(10);

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

        $stokObats = StokObat::with(['obat', 'satuanObat'])
            ->orderBy('obat_id')
            ->get();

        return view('dokter.resep-obat', compact(
            'resepObats',
            'pendaftarans',
            'dokters',
            'obats',
            'stokObats'
        ));
    }

    /**
     * Menyimpan pemeriksaan dan resep obat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'keluhan' => 'required|string',
            'resep_obat' => 'nullable|json',

            'obat_id' => 'nullable|integer|exists:master_obats,id',
            'satuan_obat_id' => 'nullable|integer|exists:master_satuan_obats,id',
            'jumlah_obat' => 'nullable|integer|min:1',
        ]);

        $pendaftaran = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])->findOrFail($validated['pendaftaran_id']);

        if (!$pendaftaran->dokter_id) {
            return back()->withInput()->withErrors([
                'pendaftaran_id' => 'Pendaftaran ini belum memiliki dokter.',
            ]);
        }

        if (
            auth()->user()->hasRole('dokter') &&
            (int) $pendaftaran->dokter_id !==
            (int) auth()->user()->dokter_id
        ) {
            return back()->withInput()->withErrors([
                'pendaftaran_id' => 'Pasien ini tidak ditugaskan kepada akun dokter Anda.',
            ]);
        }

        // Ambil daftar resep dari JSON.
        $obatList = [];

        if ($request->filled('resep_obat')) {
            $decoded = json_decode($request->resep_obat, true);

            if (!is_array($decoded)) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Format daftar resep obat tidak valid.',
                ]);
            }

            $obatList = $decoded;
        }

        // Jika menggunakan input obat langsung.
        if (empty($obatList) && $request->filled('obat_id')) {
            $obatList[] = [
                'obat_id' => $request->obat_id,
                'satuan_obat_id' => $request->satuan_obat_id,
                'jumlah' => $request->jumlah_obat,
                'dosis' => $request->dosis_obat,
                'frekuensi' => $request->frekuensi_obat,
                'lama' => $request->lama_obat,
                'aturan_pakai' => $request->aturan_pakai,
            ];
        }

        // Validasi setiap obat dan satuannya.
        $obatValid = [];

        foreach ($obatList as $obat) {
            if (!is_array($obat)) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Format detail resep tidak valid.',
                ]);
            }

            $obatId = $obat['obat_id'] ?? null;
            $satuanId = $obat['satuan_obat_id'] ?? null;
            $jumlah = $obat['jumlah'] ?? $obat['jumlah_obat'] ?? null;

            if (
                empty($obatId) ||
                empty($satuanId) ||
                !is_numeric($jumlah) ||
                (int) $jumlah < 1
            ) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Obat, satuan, dan jumlah obat wajib diisi dengan benar.',
                ]);
            }

            $masterObat = MasterObat::find($obatId);

            if (!$masterObat) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Obat tidak ditemukan.',
                ]);
            }

            // Pastikan satuan tersebut memang tersedia untuk obat yang dipilih.
            $stokTersedia = StokObat::where('obat_id', $obatId)
                ->where('satuan_obat_id', $satuanId)
                ->exists();

            if (!$stokTersedia) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Satuan obat tidak tersedia untuk obat yang dipilih.',
                ]);
            }

            $obatValid[] = [
                'obat_id' => (int) $obatId,
                'satuan_obat_id' => (int) $satuanId,
                'jumlah' => (int) $jumlah,
                'dosis' => $obat['dosis'] ?? '',
                'frekuensi' => $obat['frekuensi'] ?? '',
                'lama' => $obat['lama'] ?? '',
                'aturan_pakai' => $obat['aturan_pakai'] ?? '',
            ];
        }

        DB::transaction(function () use (
            $validated,
            $pendaftaran,
            $obatValid
        ) {
            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $pendaftaran->id,
                'dokter_id' => $pendaftaran->dokter_id,
                'keluhan' => $validated['keluhan'],
                'resep_obat' => 0,
            ]);

            if (empty($obatValid)) {
                return;
            }

            $resep = ResepObat::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'status' => 'menunggu',
            ]);

            foreach ($obatValid as $obat) {
                $aturan = [];

                if ($obat['dosis']) {
                    $aturan[] = 'Dosis: ' . $obat['dosis'];
                }

                if ($obat['frekuensi']) {
                    $aturan[] = 'Frekuensi: ' . $obat['frekuensi'];
                }

                if ($obat['aturan_pakai']) {
                    $aturan[] = 'Aturan: ' . $obat['aturan_pakai'];
                }

                if ($obat['lama']) {
                    $aturan[] = 'Lama: ' . $obat['lama'] . ' hari';
                }

                $resep->obat()->attach($obat['obat_id'], [
                    'satuan_obat_id' => $obat['satuan_obat_id'],
                    'nilai' => $obat['jumlah'],
                    'aturan_pakai' => implode(' | ', $aturan) ?: '-',
                ]);
            }
        });

        if (auth()->user()->hasRole('dokter')) {
            return redirect()
                ->route('dokter.resep.index')
                ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
        }

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
    }

    /**
     * Detail pemeriksaan.
     */
    public function show($id)
    {
        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->findOrFail($id);

        return view('pemeriksaan-dokter.show', compact('pemeriksaan'));
    }

    /**
     * Form edit pemeriksaan.
     */
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

        $stokObats = StokObat::with(['obat', 'satuanObat'])
            ->orderBy('obat_id')
            ->get();

        return view('pemeriksaan-dokter.edit', compact(
            'pemeriksaan',
            'pendaftarans',
            'dokters',
            'obats',
            'stokObats'
        ));
    }

    /**
     * Memperbarui pemeriksaan.
     */
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

    /**
     * Menghapus pemeriksaan dan resep terkait.
     */
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

    /**
     * Menampilkan daftar resep obat khusus dokter.
     */
    public function resepDokter()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
            ->latest()
            ->paginate(10);

        return view('dokter.resep-obat', compact('resepObats'));
    }
}