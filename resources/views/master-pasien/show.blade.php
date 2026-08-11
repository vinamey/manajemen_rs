@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Detail Pasien</h4>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="fw-bold">ID Pasien</label>

                <div class="form-control bg-light">
                    {{ $pasien->id }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Nama Pasien</label>

                <div class="form-control bg-light">
                    {{ $pasien->nama }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Jenis Kelamin</label>

                <div class="form-control bg-light">
                    {{ ucfirst($pasien->jenis_kelamin) }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Tanggal Lahir</label>

                <div class="form-control bg-light">
                    {{ $pasien->tanggal_lahir }}
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <label class="fw-bold">Alamat</label>

                <div class="form-control bg-light" style="height:auto;">
                    {{ $pasien->alamat }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Status Asuransi</label>

                <div class="form-control bg-light">

                    @if($pasien->status_asuransi == '01')
                        Memiliki Asuransi
                    @else
                        Tidak Memiliki Asuransi
                    @endif

                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Golongan Darah</label>

                <div class="form-control bg-light">
                    {{ $pasien->golongan_darah }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Dibuat Pada</label>

                <div class="form-control bg-light">
                    {{ $pasien->created_at }}
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label class="fw-bold">Terakhir Diubah</label>

                <div class="form-control bg-light">
                    {{ $pasien->updated_at }}
                </div>
            </div>

        </div>


        <div class="mt-3">

            <a
                href="{{ route('master-pasien.edit', $pasien->id) }}"
                class="btn btn-warning">

                <i class="fa fa-edit"></i>
                Edit

            </a>

            <a
                href="{{ route('master-pasien.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection