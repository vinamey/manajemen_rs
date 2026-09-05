@extends('layouts.superadmin')

@section('content')
<div class="container-fluid p-4" style="background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Page -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-3 rounded-4 d-flex align-items-center justify-content-center" style="background-color: #e0edff; color: #1d72f3; width: 48px; height: 48px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9 3.5 12.5l3.5.207 6.5-6.5zm-8.354 8.354L1 15l.5-3.5 3 3z"/>
            </svg>
        </div>
        <div>
            <h3 class="fw-bold mb-0 text-dark">Edit Supplier</h3>
            <small class="text-muted">Perbarui data supplier</small>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <form action="{{ route('master-supplier.update', $masterSupplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark">Kode Supplier <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="kode" 
                               class="form-control rounded-3 py-2 px-3 @error('kode') is-invalid @enderror" 
                               value="{{ old('kode', $masterSupplier->kode) }}" 
                               placeholder="Contoh: SUP01" 
                               required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark">Nama Supplier <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nama" 
                               class="form-control rounded-3 py-2 px-3 @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $masterSupplier->nama) }}" 
                               placeholder="Nama" 
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('master-supplier.index') }}" class="btn btn-light fw-medium px-4 py-2 rounded-3 border">
                        Batal
                    </a>
                    <button type="submit" class="btn text-white fw-medium px-4 py-2 rounded-3 border-0" style="background-color: #1d72f3;">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection