
@extends('layouts.superadmin')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold">Edit Hasil Pemeriksaan</h3>
        <p class="text-muted">Perbarui informasi hasil pemeriksaan pasien.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('hasil-pemeriksaan.update', $hasilPemeriksaan->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                @include('hasil-pemeriksaan._form', [
                    'hasilPemeriksaan' => $hasilPemeriksaan
                ])

                
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
