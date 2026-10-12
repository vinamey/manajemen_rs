<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaan;
use App\Models\PemeriksaanDokter;
use App\Models\MasterTindakan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HasilPemeriksaanController extends Controller
{
    private function dataForm()
    {
        return [
            'pemeriksaans' => PemeriksaanDokter::with([
                'pendaftaran.pasien',
                'dokter',
            ])->latest()->get(),

            'tindakans' => MasterTindakan::orderBy('nama')->get(),
        ];
    }

    public function index()
    {
        $hasilPemeriksaans = HasilPemeriksaan::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'tindakan',
        ])->latest()->paginate(10);

        return view(
            'hasil-pemeriksaan.index',
            compact('hasilPemeriksaans')
        );
    }

    public function create()
    {
        return view(
            'hasil-pemeriksaan.create',
            $this->dataForm()
        );
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'pemeriksaan_id' => [
            'required',
            'integer',
            'exists:pemeriksaan_dokters,id',
        ],
        'tanggal_pemeriksaan' => [
            'required',
            'date',
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

    $pemeriksaan = PemeriksaanDokter::with('pendaftaran')
        ->findOrFail($validated['pemeriksaan_id']);

    \Illuminate\Support\Facades\DB::transaction(function () use (
        $validated,
        $pemeriksaan
    ) {
        HasilPemeriksaan::create($validated);

        // Ubah status pendaftaran pasien menjadi Selesai.
        if ($pemeriksaan->pendaftaran) {
            $pemeriksaan->pendaftaran->update([
                'status' => 'Selesai',
            ]);
        }
    });

    return redirect()
        ->route('hasil-pemeriksaan.index')
        ->with(
            'success',
            'Hasil pemeriksaan berhasil disimpan dan status pendaftaran pasien diperbarui menjadi Selesai.'
        );
}

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

    public function edit(HasilPemeriksaan $hasilPemeriksaan)
    {
        return view(
            'hasil-pemeriksaan.edit',
            array_merge(
                $this->dataForm(),
                compact('hasilPemeriksaan')
            )
        );
    }

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
            'tanggal_pemeriksaan' => [
                'required',
                'date',
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

        $hasilPemeriksaan->update($validated);

        return redirect()
            ->route('hasil-pemeriksaan.index')
            ->with('success', 'Hasil pemeriksaan berhasil diperbarui.');
    }

    public function destroy(HasilPemeriksaan $hasilPemeriksaan)
    {
        $hasilPemeriksaan->delete();

        return redirect()
            ->route('hasil-pemeriksaan.index')
            ->with('success', 'Hasil pemeriksaan berhasil dihapus.');
    }
}
