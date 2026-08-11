@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Pasien</h4>

        <a href="{{ route('master-pasien.create') }}"
           class="btn btn-success">
            + Tambah Pasien
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Status Asuransi</th>
                        <th>Golongan Darah</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($pasiens as $pasien)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $pasien->nama }}</td>

                        <td>{{ $pasien->jenis_kelamin }}</td>

                        <td>{{ $pasien->tanggal_lahir }}</td>

                        <td>{{ $pasien->alamat }}</td>

                        <td>
                            @if($pasien->status_asuransi == '01')
                                Memiliki Asuransi
                            @else
                                Tidak Memiliki Asuransi
                            @endif
                        </td>

                        <td>{{ $pasien->golongan_darah }}</td>

                        <td>

                            <a href="{{ route('master-pasien.show', $pasien->id) }}"
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>

                            <a href="{{ route('master-pasien.edit', $pasien->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master-pasien.destroy', $pasien->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data pasien ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            Belum ada data pasien
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection