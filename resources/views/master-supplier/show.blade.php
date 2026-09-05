@extends('layouts.superadmin')

@section('content')
<div class="container-fluid p-4" style="background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Page -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-3 rounded-4 d-flex align-items-center justify-content-center" style="background-color: #e0f2fe; color: #0284c7; width: 48px; height: 48px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
        </div>
        <div>
            <h3 class="fw-bold mb-0 text-dark">Detail Supplier</h3>
            <small class="text-muted">Informasi lengkap data supplier</small>
        </div>
    </div>

    <!-- Detail Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium text-dark">Kode Supplier</label>
                    <input type="text" class="form-control rounded-3 py-2 px-3 bg-light text-secondary" value="{{ $masterSupplier->kode }}" readonly disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium text-dark">Nama Supplier</label>
                    <input type="text" class="form-control rounded-3 py-2 px-3 bg-light text-dark fw-medium" value="{{ $masterSupplier->nama }}" readonly disabled>
                </div>
            </div>

            <div class="d-flex justify-content-start gap-2 mt-4 pt-2">
                <a href="{{ route('master-supplier.index') }}" class="btn btn-light fw-medium px-4 py-2 rounded-3 border">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection