@extends('layouts.superadmin')

@section('content')
<style>
    .hasil-form-page {
        padding: 20px 22px;
        min-height: calc(100vh - 60px);
        background: #f4f6fa;
    }

    .hasil-form-header {
        background: linear-gradient(110deg, #1877f2, #0f58c6);
        color: #fff;
        padding: 22px 24px;
        border-radius: 17px;
        margin-bottom: 22px;
        box-shadow: 0 8px 20px rgba(24, 119, 242, .15);
    }

    .hasil-form-header h3 {
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .hasil-form-header p {
        color: rgba(255,255,255,.9);
        margin: 0;
        font-size: 14px;
    }

    .hasil-form-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 7px 22px rgba(31,45,61,.07);
    }

    .hasil-form-card-header {
        padding: 17px 22px;
        background: #e7f1ff;
        border-bottom: 1px solid #d5e6ff;
        color: #164f9f;
        font-size: 17px;
        font-weight: 700;
    }

    .hasil-form-card-header i {
        color: #1877f2;
        margin-right: 9px;
    }

    .hasil-form-body {
        padding: 24px;
    }

    .hasil-form-body .form-label {
        color: #253449;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .hasil-form-body .form-control,
    .hasil-form-body .form-select {
        border: 1px solid #d9e2ef;
        border-radius: 9px;
        padding: 10px 12px;
        font-size: 14px;
        color: #35445b;
        background-color: #fbfdff;
        transition: border-color .2s, box-shadow .2s;
    }

    .hasil-form-body .form-control:focus,
    .hasil-form-body .form-select:focus {
        border-color: #1877f2;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(24,119,242,.12);
    }

    .hasil-form-body textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .hasil-form-body .form-text {
        font-size: 12px;
        color: #718096;
        margin-top: 6px;
    }

    .hasil-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 17px 24px;
        background: #f8faff;
        border-top: 1px solid #e8edf5;
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

    .btn-hasil-kembali {
        background: #e8eef7;
        color: #40516a;
        border: 1px solid #d9e2ef;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-hasil-kembali:hover {
        background: #dce6f3;
        color: #253449;
    }

    .hasil-alert {
        border-radius: 10px;
        border: none;
    }

    @media (max-width: 768px) {
        .hasil-form-page {
            padding: 15px 10px;
        }

        .hasil-form-header {
            padding: 20px;
        }

        .hasil-form-header h3 {
            font-size: 21px;
        }

        .hasil-form-body {
            padding: 18px;
        }

        .hasil-form-actions {
            padding: 15px 18px;
            flex-wrap: wrap;
        }
    }
</style>

<div class="hasil-form-page">

    {{-- HEADER --}}
    <div class="hasil-form-header">
        <h3>
            <i class="fas fa-file-medical me-2"></i>
            Tambah Hasil Pemeriksaan
        </h3>
        <p>Kelola hasil pemeriksaan, diagnosis, dan kondisi pasien.</p>
    </div>

    {{-- PESAN VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger hasil-alert">
            <strong><i class="fas fa-exclamation-circle me-2"></i>
                Periksa kembali data berikut:
            </strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="hasil-form-card">

        <div class="hasil-form-card-header">
            <i class="fas fa-notes-medical"></i>
            Formulir Hasil Pemeriksaan
        </div>

        <div class="hasil-form-body">
            @include('hasil-pemeriksaan._form', [
                'hasil' => null,
                'pemeriksaans' => $pemeriksaans,
                'tindakans' => $tindakans
            ])
        </div>

    </div>
</div>
@endsection
