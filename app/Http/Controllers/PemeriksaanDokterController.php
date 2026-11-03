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

        return view('pemeriksaan-dokter.index', compact(
            'pemeriksaans',
            'pendaftarans',
            'dokters',
            'obats'
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

        return view('dokter.resep-obat', compact(
            'resepObats',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    /**
     * Menyimpan pemeriksaan dan resep obat.
     */
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

            'obat_id' => [
                'nullable',
                'integer',
                'exists:master_obats,id',
            ],

            'jumlah_obat' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ]);

        // Ambil data pendaftaran.
        $pendaftaran = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])->findOrFail($validated['pendaftaran_id']);

        if (!$pendaftaran->dokter_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'pendaftaran_id' =>
                        'Pendaftaran ini belum memiliki dokter.',
                ]);
        }

        // Dokter hanya boleh memeriksa pasien yang ditugaskan kepadanya.
        if (
            auth()->user()->hasRole('dokter') &&
            (int) $pendaftaran->dokter_id !==
            (int) auth()->user()->dokter_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'pendaftaran_id' =>
                        'Pasien ini tidak ditugaskan kepada akun dokter Anda.',
                ]);
        }

        /*
         * MEMBACA DATA RESEP
         *
         * Mendukung dua format:
         * 1. JSON resep_obat.
         * 2. Input langsung dari form pemeriksaan dokter.
         */

        $obatList = [];

        $jsonResep = $request->input('resep_obat');

        if (!empty($jsonResep)) {
            $decoded = json_decode($jsonResep, true);

            if (!is_array($decoded)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'resep_obat' =>
                            'Format daftar resep obat tidak valid.',
                    ]);
            }

            $obatList = $decoded;
        }

        /*
         * Jika JSON kosong, ambil data dari input langsung.
         */
        if (
            empty($obatList) &&
            $request->filled('obat_id')
        ) {
            $obatList[] = [
                'obat_id' => $request->input('obat_id'),
                'jumlah' => $request->input('jumlah_obat'),
                'dosis' => $request->input('dosis_obat'),
                'frekuensi' => $request->input('frekuensi_obat'),
                'lama' => $request->input('lama_obat'),
                'aturan_pakai' => $request->input('aturan_pakai'),
            ];
        }

        /*
         * VALIDASI DAFTAR OBAT
         */
        $obatValid = [];

        foreach ($obatList as $obat) {
            if (!is_array($obat)) {
                continue;
            }

            $obatId = $obat['obat_id'] ?? null;

            $jumlah = $obat['jumlah']
                ?? $obat['jumlah_obat']
                ?? null;

            if (
                empty($obatId) ||
                !is_numeric($jumlah) ||
                (int) $jumlah < 1
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'resep_obat' =>
                            'Obat dan jumlah obat harus diisi dengan benar.',
                    ]);
            }

            $obatModel = MasterObat::find((int) $obatId);

            if (!$obatModel) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'resep_obat' =>
                            'Obat tidak ditemukan. Silakan periksa kembali.',
                    ]);
            }

            $obatValid[] = [
                'obat_id' => (int) $obatId,
                'jumlah' => (int) $jumlah,
                'dosis' => $obat['dosis'] ?? '',
                'frekuensi' => $obat['frekuensi'] ?? '',
                'lama' => $obat['lama'] ?? '',
                'aturan_pakai' => $obat['aturan_pakai'] ?? '',
            ];
        }

        /*
         * SIMPAN PEMERIKSAAN DAN RESEP
         */
        DB::transaction(function () use (
            $validated,
            $pendaftaran,
            $obatValid
        ) {
            // Simpan pemeriksaan.
            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $pendaftaran->id,
                'dokter_id' => $pendaftaran->dokter_id,
                'keluhan' => $validated['keluhan'],
                'resep_obat' => 0,
            ]);

            // Jika tidak ada obat, pemeriksaan tetap disimpan.
            if (empty($obatValid)) {
                return;
            }

            // Buat data resep.
            $resep = ResepObat::create([
                'pemeriksaan_id' => $pemeriksaan->id,
            ]);

            // Simpan detail obat ke tabel pivot.
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
                    $obat['obat_id'],
                    [
                        'satuan_obat_id' => null,
                        'nilai' => $obat['jumlah'],
                        'aturan_pakai' => implode(' | ', $aturan) ?: '-',
                    ]
                );
            }
        });

        // Redirect sesuai role pengguna.
        if (auth()->user()->hasRole('dokter')) {
            return redirect()
                ->route('dokter.resep.index')
                ->with(
                    'success',
                    'Pemeriksaan dan resep obat berhasil disimpan.'
                );
        }

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with(
                'success',
                'Pemeriksaan dan resep obat berhasil disimpan.'
            );
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

        return view(
            'pemeriksaan-dokter.show',
            compact('pemeriksaan')
        );
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

        return view('pemeriksaan-dokter.edit', compact(
            'pemeriksaan',
            'pendaftarans',
            'dokters',
            'obats'
        ));
    }

    /**
     * Memperbarui pemeriksaan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pendaftaran_id' =>
                'required|exists:pendaftaran_pasiens,id',

            'dokter_id' =>
                'required|exists:master_dokters,id',

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
