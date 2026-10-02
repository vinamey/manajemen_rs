@extends('layouts.superadmin')

@section('page-title', 'Resep dari Dokter')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: white;
        border-radius: 16px;
        padding: 22px 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(24, 119, 242, 0.18);
    }

    .page-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .page-header p {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .recipe-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .recipe-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f4;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .recipe-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1f2937;
    }

    .recipe-table {
        margin: 0;
    }

    .recipe-table thead th {
        background: #f4f8ff;
        color: #31557f;
        font-size: 13px;
        font-weight: 700;
        border-bottom: 1px solid #dce8f8;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .recipe-table tbody td {
        padding: 15px 16px;
        vertical-align: middle;
        font-size: 14px;
        color: #374151;
    }

    .recipe-table tbody tr:hover {
        background: #f8fbff;
    }

    .patient-name {
        font-weight: 700;
        color: #1877f2;
    }

    .doctor-name {
        font-weight: 600;
        color: #374151;
    }

    .medicine-badge {
        display: inline-block;
        background: #e7f3ff;
        color: #0f58c6;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        margin: 2px;
    }

    .quantity-badge {
        background: #eefbf3;
        color: #16834b;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 42px;
        color: #b8c8dc;
        margin-bottom: 12px;
    }

    .empty-state h6 {
        font-weight: 700;
        color: #4b5563;
    }

    .empty-state p {
        font-size: 13px;
        margin: 0;
    }

    .pagination-wrapper {
        padding: 15px 20px;
        border-top: 1px solid #edf0f4;
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="page-header">
        <h4>
            <i class="fa-solid fa-file-prescription me-2"></i>
            Resep dari Dokter
        </h4>

        <p>
            Daftar resep obat yang diberikan oleh dokter kepada pasien.
        </p>
    </div>


    {{-- DATA RESEP --}}
    <div class="recipe-card">

        <div class="recipe-card-header">
            <h5>
                <i class="fa-solid fa-prescription-bottle-medical text-primary me-2"></i>
                Daftar Resep
            </h5>
        </div>

        <div class="table-responsive">

            <table class="table recipe-table mb-0">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($resepObats as $index => $resep)

                        <tr>

                            <td>
                                {{ $resepObats->firstItem() + $index }}
                            </td>

                            <td>
                                <div class="patient-name">
                                    {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="doctor-name">
                                    <i class="fa-solid fa-user-doctor text-primary me-1"></i>
                                    {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                </span>
                            </td>

                            <td>

                                @forelse($resep->obat as $obat)

                                    <span class="medicine-badge">
                                        {{ $obat->nama }}
                                    </span>

                                @empty

                                    <span class="text-muted">
                                        Tidak ada obat
                                    </span>

                                @endforelse

                            </td>

                            <td>

                                @forelse($resep->obat as $obat)

                                    <span class="quantity-badge">
                                        {{ $obat->pivot->nilai }}
                                    </span>

                                @empty

                                    -

                                @endforelse

                            </td>

                            <td>

                                @forelse($resep->obat as $obat)

                                    <div class="mb-1">
                                        {{ $obat->pivot->aturan_pakai ?: '-' }}
                                    </div>

                                @empty

                                    -

                                @endforelse

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">

                                <div class="empty-state">

                                    <i class="fa-solid fa-file-prescription d-block"></i>

                                    <h6>Belum Ada Resep</h6>

                                    <p>
                                        Belum ada resep obat dari dokter yang tersedia.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($resepObats->hasPages())

            <div class="pagination-wrapper">
                {{ $resepObats->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
