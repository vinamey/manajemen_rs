<style>
    .hasil-form-body .form-label,
    .form-label {
        cursor: default;
        user-select: none;
        pointer-events: none;
    }

    .hasil-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        padding: 18px 24px;
        margin: 24px -24px -24px;
        background: #f4f8ff;
        border-top: 1px solid #dce8f8;
    }

    .btn-hasil-kembali {
        background: #e8eef7;
        color: #40516a;
        border: 1px solid #d9e2ef;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-hasil-kembali:hover {
        background: #dce6f3;
        color: #253449;
    }

    .btn-hasil-simpan {
        background: #1877f2;
        color: #fff;
        border: 1px solid #1877f2;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-hasil-simpan:hover {
        background: #0f58c6;
        border-color: #0f58c6;
        color: #fff;
    }

    .hasil-form-error {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .hasil-form-actions {
            margin-left: -18px;
            margin-right: -18px;
            margin-bottom: -18px;
            padding: 15px 18px;
        }
    }
</style>

@php
    $hasilPemeriksaan = $hasilPemeriksaan ?? $hasil ?? null;

    $nilai = fn($field, $default = '') =>
        old($field, data_get($hasilPemeriksaan, $field, $default));

    $modeEdit = isset($hasilPemeriksaan) && $hasilPemeriksaan !== null;
@endphp

<form
    action="{{ $modeEdit
        ? route('hasil-pemeriksaan.update', $hasilPemeriksaan->id)
        : route('hasil-pemeriksaan.store') }}"
    method="POST"
>
    @csrf

    @if($modeEdit)
        @method('PUT')
    @endif

    <div class="row g-3">

        {{-- PEMERIKSAAN DOKTER --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Pemeriksaan Dokter</label>

            <select name="pemeriksaan_id"
                    id="pemeriksaan_id"
                    class="form-select @error('pemeriksaan_id') is-invalid @enderror">
                <option value="">Pilih pemeriksaan dokter</option>

                @foreach($pemeriksaans as $pemeriksaan)
                    <option
                        value="{{ $pemeriksaan->id }}"
                        data-keluhan="{{ $pemeriksaan->keluhan }}"
                        @selected((string) $nilai('pemeriksaan_id') === (string) $pemeriksaan->id)
                    >
                        {{ $pemeriksaan->pendaftaran?->pasien?->nama ?? 'Pasien tidak diketahui' }}
                        — {{ $pemeriksaan->dokter?->nama ?? 'Dokter tidak diketahui' }}
                        — ID {{ $pemeriksaan->id }}
                    </option>
                @endforeach
            </select>

            <small class="text-muted">
                Keluhan akan diisi dari pemeriksaan dokter yang dipilih.
            </small>

            @error('pemeriksaan_id')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

      <div class="mb-3">
    <label class="form-label fw-semibold">Tanggal Pemeriksaan</label>

    <input type="date"
           class="form-control"
           value="{{ now()->format('Y-m-d') }}"
           disabled>

    <input type="hidden"
           name="tanggal_pemeriksaan"
           value="{{ now()->format('Y-m-d') }}">
</div>

        {{-- KELUHAN --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Keluhan Pasien</label>

            <textarea name="keluhan"
                      id="keluhan"
                      class="form-control @error('keluhan') is-invalid @enderror"
                      rows="3"
                      required>{{ $nilai('keluhan') }}</textarea>

            @error('keluhan')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- DIAGNOSIS --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Diagnosis</label>

            <textarea name="diagnosa"
                      class="form-control @error('diagnosa') is-invalid @enderror"
                      rows="3"
                      required>{{ $nilai('diagnosa') }}</textarea>

            @error('diagnosa')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- TINDAKAN --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Tindakan Medis</label>

            <select name="tindakan_id"
                    class="form-select @error('tindakan_id') is-invalid @enderror">
                <option value="">Pilih tindakan (opsional)</option>

                @foreach($tindakans as $tindakan)
                    <option value="{{ $tindakan->id }}"
                        @selected((string) $nilai('tindakan_id') === (string) $tindakan->id)>
                        {{ $tindakan->nama }}
                    </option>
                @endforeach
            </select>

            @error('tindakan_id')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- SUHU --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Suhu Tubuh (°C)</label>

            <input type="number"
                   name="suhu_tubuh"
                   class="form-control @error('suhu_tubuh') is-invalid @enderror"
                   step="0.1"
                   min="20"
                   max="50"
                   value="{{ $nilai('suhu_tubuh') }}"
                   required>

            @error('suhu_tubuh')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- BERAT BADAN --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Berat Badan (kg)</label>

            <input type="number"
                   name="berat_badan"
                   class="form-control @error('berat_badan') is-invalid @enderror"
                   step="0.01"
                   min="0.01"
                   max="999.99"
                   value="{{ $nilai('berat_badan') }}"
                   required>

            @error('berat_badan')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- TINGGI BADAN --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Tinggi Badan (cm)</label>

            <input type="number"
                   name="tinggi_badan"
                   class="form-control @error('tinggi_badan') is-invalid @enderror"
                   step="0.01"
                   min="0.01"
                   max="999.99"
                   value="{{ $nilai('tinggi_badan') }}"
                   required>

            @error('tinggi_badan')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- CATATAN --}}
        <div class="col-12">
            <label class="form-label fw-semibold">Catatan Pemeriksaan</label>

            <textarea name="catatan"
                      class="form-control @error('catatan') is-invalid @enderror"
                      rows="4"
                      required>{{ $nilai('catatan') }}</textarea>

            @error('catatan')
                <div class="hasil-form-error">{{ $message }}</div>
            @enderror
        </div>

    </div>

    {{-- TOMBOL KEMBALI DAN SIMPAN --}}
    <div class="hasil-form-actions">
        <a href="{{ route('hasil-pemeriksaan.index') }}"
           class="btn btn-hasil-kembali">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali
        </a>

        <button type="submit" class="btn btn-hasil-simpan">
            <i class="fas fa-save me-1"></i>
            {{ $modeEdit ? 'Simpan Perubahan' : 'Simpan Hasil' }}
        </button>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pemeriksaan = document.getElementById('pemeriksaan_id');
    const keluhan = document.getElementById('keluhan');

    if (pemeriksaan && keluhan) {
        pemeriksaan.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];

            if (this.value && option) {
                keluhan.value = option.dataset.keluhan || '';
            }
        });
    }
});
</script>
