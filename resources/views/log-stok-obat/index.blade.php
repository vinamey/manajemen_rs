@extends('layouts.superadmin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark">Log Stok Obat</h5>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-top">
                            <thead style="background-color: #0d6efd; color: #ffffff;">
                                <tr style="background-color: #0d6efd;">
                                    <th class="py-3 px-4 text-white" style="width: 5%; background-color: #0d6efd !important;">No</th>
                                    <th class="py-3 px-3 text-white" style="background-color: #0d6efd !important;">Tanggal Update</th>
                                    <th class="py-3 px-3 text-white" style="background-color: #0d6efd !important;">Nama / ID Obat</th>
                                    <th class="py-3 px-3 text-white" style="background-color: #0d6efd !important;">Status</th>
                                    <th class="py-3 px-3 text-white" style="background-color: #0d6efd !important;">Jumlah (Nilai)</th>
                                    <th class="py-3 px-3 text-white" style="background-color: #0d6efd !important;">Stok Tersedia</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                                @forelse ($logs as $index => $log)
                                    @php
                                        $isBertambah = $log->nilai > 0 || !empty($log->pembelian_obat_id);
                                    @endphp
                                    <tr>
                                        <td>{{ $logs->firstItem() + $index }}</td>
                                        <td>
                                            {{ $log->tanggal_update ? \Carbon\Carbon::parse($log->tanggal_update)->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td>
                                            <span class="fw-semibold">
                                                {{ $log->obat->nama_obat ?? $log->obat->nama ?? 'ID Obat: ' . $log->obat_id }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($isBertambah)
                                                <span class="text-success fw-bold">Bertambah</span>
                                            @else
                                                <span class="text-danger fw-bold">Berkurang</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($isBertambah)
                                                <span class="text-success">+{{ abs($log->nilai) }}</span>
                                            @else
                                                <span class="text-danger">-{{ abs($log->nilai) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $log->stokObat->stok ?? $log->stokObat->jumlah ?? $log->obat->stok ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            Belum ada data riwayat log stok obat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection