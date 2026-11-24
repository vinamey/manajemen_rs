<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaan;
use App\Models\PemeriksaanDokter;
use App\Models\MasterTindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilPemeriksaanController extends Controller
{
    /**
     * DATA FORM PEMERIKSAAN
     * Create hanya menampilkan pemeriksaan hari ini.
     * Edit tetap bisa menampilkan pemeriksaan lama yang sedang diedit.
     */
    private function dataForm($hasilPemeriksaan = null)
    {
        $tanggalHariIni = now()->toDateString();

        $query = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
        ]);

        $query->where(function ($q) use (
            $tanggalHariIni,
            $hasilPemeriksaan
        ) {
            // Pemeriksaan dari pendaftaran hari ini.
            $q->whereHas('pendaftaran', function ($subQuery) use (
                $tanggalHariIni
            ) {
                $subQuery->whereDate(
                    'tanggal_pendaftaran',
                    $tanggalHariIni
                );
            });

            // Saat edit, pemeriksaan lama tetap tersedia.
            if ($hasilPemeriksaan && $hasilPemeriksaan->pemeriksaan_id) {
                $q->orWhere(
                    'id',
                    $hasilPemeriksaan->pemeriksaan_id
                );
            }
        });

        return [
            'pemeriksaans' => $query
                ->latest()
                ->get(),

            'tindakans' => MasterTindakan::orderBy('nama')
                ->get(),
        ];
    }

    /**
     * MENAMPILKAN SELURUH HASIL PEMERIKSAAN
     * Data kemarin dan data sebelumnya tidak dihapus.
     */
    public function index()
    {
        $hasilPemeriksaans = HasilPemeriksaan::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'tindakan',
        ])
            ->latest()
            ->paginate(10);

        return view(
            'hasil-pemeriksaan.index',
            compact('hasilPemeriksaans')
        );
    }

    /**
     * FORM TAMBAH HASIL PEMERIKSAAN
     */
    public function create()
    {
        return view(
            'hasil-pemeriksaan.create',
            $this->dataForm()
        );
    }

    /**
     * MENYIMPAN HASIL PEMERIKSAAN
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'pemeriksaan_id' => [
                'required',
                'integer',
                'exists:pemeriksaan_dokters,id',
            ],

            'keluhan' => [
                'required',
                'string',
            ],

            'diagnosa' => [
                'required',
                'string',
            ],

            'tindakan_id' => [
                'nullable',
                'integer',
                'exists:master_tindakans,id',
            ],

            'suhu_tubuh' => [
                'required',
                'numeric',
                'between:20,50',
            ],

            'berat_badan' => [
                'required',
                'numeric',
                'between:0.01,999.99',
            ],

            'tinggi_badan' => [
                'required',
                'numeric',
                'between:0.01,999.99',
            ],

            'catatan' => [
                'required',
                'string',
            ],

        ]);

        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran',
        ])->findOrFail($validated['pemeriksaan_id']);

        // Pastikan pemeriksaan berasal dari pendaftaran hari ini.
        $tanggalHariIni = now()->toDateString();

        if (
            !$pemeriksaan->pendaftaran ||
            $pemeriksaan->pendaftaran->tanggal_pendaftaran === null ||
            \Carbon\Carbon::parse(
                $pemeriksaan->pendaftaran->tanggal_pendaftaran
            )->toDateString() !== $tanggalHariIni
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'pemeriksaan_id' =>
                        'Hanya pemeriksaan dari pendaftaran hari ini yang dapat ditambahkan.',
                ]);
        }

        // Cegah satu pemeriksaan dibuatkan hasil lebih dari sekali.
        if (
            HasilPemeriksaan::where(
                'pemeriksaan_id',
                $pemeriksaan->id
            )->exists()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'pemeriksaan_id' =>
                        'Hasil pemeriksaan untuk pasien ini sudah tersedia.',
                ]);
        }

        // Tanggal selalu ditentukan server, bukan dari input pengguna.
        $validated['tanggal_pemeriksaan'] = now()->toDateString();

        DB::transaction(function () use (
            $validated,
            $pemeriksaan
        ) {

            HasilPemeriksaan::create($validated);

            // Ubah status pendaftaran menjadi selesai.
            if ($pemeriksaan->pendaftaran) {
                $pemeriksaan->pendaftaran->update([
                    'status' => 'selesai',
                ]);
            }

        });

        return redirect()
            ->route('hasil-pemeriksaan.index')
            ->with(
                'success',
                'Hasil pemeriksaan berhasil disimpan dan status pasien menjadi selesai.'
            );
    }

    /**
     * DETAIL HASIL PEMERIKSAAN
     */
    public function show(HasilPemeriksaan $hasilPemeriksaan)
    {
        $hasilPemeriksaan->load([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'tindakan',
        ]);

        return view(
            'hasil-pemeriksaan.show',
            compact('hasilPemeriksaan')
        );
    }

    /**
     * FORM EDIT HASIL PEMERIKSAAN
     */
    public function edit(HasilPemeriksaan $hasilPemeriksaan)
    {
        $hasilPemeriksaan->load([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'tindakan',
        ]);

        return view(
            'hasil-pemeriksaan.edit',
            array_merge(
                $this->dataForm($hasilPemeriksaan),
                compact('hasilPemeriksaan')
            )
        );
    }

    /**
     * UPDATE HASIL PEMERIKSAAN
     * Tanggal pemeriksaan lama tidak ikut diubah.
     */
    public function update(
        Request $request,
        HasilPemeriksaan $hasilPemeriksaan
    ) {
        $validated = $request->validate([

            'pemeriksaan_id' => [
                'nullable',
                'integer',
                'exists:pemeriksaan_dokters,id',
            ],

            'keluhan' => [
                'required',
                'string',
            ],

            'diagnosa' => [
                'required',
                'string',
            ],

            'tindakan_id' => [
                'nullable',
                'integer',
                'exists:master_tindakans,id',
            ],

            'suhu_tubuh' => [
                'required',
                'numeric',
                'between:20,50',
            ],

            'berat_badan' => [
                'required',
                'numeric',
                'between:0.01,999.99',
            ],

            'tinggi_badan' => [
                'required',
                'numeric',
                'between:0.01,999.99',
            ],

            'catatan' => [
                'required',
                'string',
            ],

        ]);

        // Jangan mengubah tanggal_pemeriksaan saat edit.
        unset($validated['tanggal_pemeriksaan']);

        $hasilPemeriksaan->update($validated);

        return redirect()
            ->route('hasil-pemeriksaan.index')
            ->with(
                'success',
                'Data hasil pemeriksaan berhasil diperbarui.'
            );
    }

    /**
     * HAPUS HASIL PEMERIKSAAN
     */
    public function destroy(HasilPemeriksaan $hasilPemeriksaan)
    {
        $hasilPemeriksaan->delete();

        return redirect()
            ->route('hasil-pemeriksaan.index')
            ->with(
                'success',
                'Data hasil pemeriksaan berhasil dihapus.'
            );
    }
}
