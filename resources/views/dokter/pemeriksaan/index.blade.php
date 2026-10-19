
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemeriksaan dan Resep Obat Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6fa; color: #263449; font-family: Arial, sans-serif; }
        .topbar { background: white; padding: 22px 28px; border-bottom: 1px solid #e5eaf2; }
        .content { padding: 26px; }
        .panel { background: white; border: 1px solid #e5eaf2; border-radius: 12px; padding: 22px; margin-bottom: 22px; }
        .btn-blue { background: #1877f2; color: white; }
        .btn-blue:hover { background: #0f58c6; color: white; }
        .table thead th { background: #1877f2; color: white; white-space: nowrap; }
        .form-label { font-weight: 600; }
        .muted { color: #758197; font-size: 14px; }
    </style>
</head>
<body>

<header class="topbar">
    <h4 class="mb-1">Pemeriksaan dan Resep Obat</h4>
    <div class="muted">Kelola pemeriksaan pasien dan resep obat</div>
</header>

<main class="content container-fluid">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

    <section class="panel">
        <h5 class="mb-1">Pendaftaran Pasien</h5>
        <p class="muted mb-3">Pasien yang belum memiliki data pemeriksaan.</p>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $pendaftaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendaftaran->pasien->nama ?? '-' }}</td>
                            <td>{{ $pendaftaran->dokter->nama ?? '-' }}</td>
                            <td>{{ $pendaftaran->poli->nama ?? '-' }}</td>
                            <td>{{ $pendaftaran->tanggal_pendaftaran ?? '-' }}</td>
                            <td>

<button type="button"
    class="btn btn-sm btn-blue"
    onclick="pilihPasien(
        @js($pendaftaran->id),
        @js($pendaftaran->pasien->nama ?? '-'),
        @js($pendaftaran->dokter->nama ?? '-'),
        @js($pendaftaran->keluhan ?? '')
    )">
    Periksa
</button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Belum ada pendaftaran yang menunggu pemeriksaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel" id="formPemeriksaan">
        <h5 class="mb-1">Formulir Pemeriksaan</h5>
        <p class="muted mb-4">Isi hasil pemeriksaan dan resep obat pasien.</p>

        <form action="{{ route('dokter.pemeriksaan.store') }}" method="POST" id="formDokter">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Pasien</label>
                    <input type="text" id="namaPasien" class="form-control"
                        placeholder="Pilih pasien dari tabel di atas" readonly>
                    <input type="hidden" name="pendaftaran_id" id="pendaftaran_id"
                        value="{{ old('pendaftaran_id') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dokter</label>
                    <input type="text" id="namaDokter" class="form-control"
                        placeholder="Mengikuti data pendaftaran" readonly>
                </div>

                <div class="col-12">
                    <label class="form-label">Keluhan Pasien</label>
                    <textarea name="keluhan" class="form-control" rows="3"
                        required>{{ old('keluhan') }}</textarea>
                </div>
            </div>

            <hr class="my-4">

            <h6 class="mb-3">Resep Obat</h6>
            <p class="muted">Tambahkan obat yang diperlukan. Jumlah diisi sebagai angka.</p>

            <div id="daftarObat"></div>

            <button type="button" class="btn btn-outline-primary btn-sm mt-2"
                onclick="tambahObat()">
                + Tambah Obat
            </button>

            <input type="hidden" name="resep_obat" id="resep_obat" value="[]">

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-blue">
                    Simpan Pemeriksaan
                </button>
                <button type="reset" class="btn btn-outline-secondary"
                    onclick="resetFormDokter()">
                    Reset
                </button>
            </div>
        </form>
    </section>

    <section class="panel">
        <h5 class="mb-3">Riwayat Pemeriksaan</h5>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Resep Obat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaans as $pemeriksaan)
                        <tr>
                            <td>{{ $pemeriksaans->firstItem() + $loop->index }}</td>
                            <td>{{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}</td>
                            <td>{{ $pemeriksaan->dokter->nama ?? '-' }}</td>
                            <td>{{ $pemeriksaan->keluhan }}</td>
                            <td>
                                @forelse($pemeriksaan->resep?->obat ?? [] as $obat)
                                    <div>{{ $obat->nama ?? 'Obat' }} — jumlah: {{ $obat->pivot->nilai ?? '-' }}</div>
                                @empty
                                    <span class="text-muted">Tidak ada resep</span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                Belum ada riwayat pemeriksaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $pemeriksaans->links() }}
    </section>

</main>

<script>
    const daftarObat = document.getElementById('daftarObat');
    let jumlahBarisObat = 0;


function pilihPasien(id, nama, dokter, keluhan) {
    document.getElementById('pendaftaran_id').value = id;
    document.getElementById('namaPasien').value = nama;
    document.getElementById('namaDokter').value = dokter;

    document.querySelector('textarea[name="keluhan"]').value = keluhan || '';

    document.getElementById('formPemeriksaan').scrollIntoView({
        behavior: 'smooth'
    });
}

    function tambahObat() {
        const baris = document.createElement('div');
        baris.className = 'row g-2 align-items-end mb-3 border rounded p-3 mx-0';

        const pilihanObat = @json($obats->map(fn($obat) => [
            'id' => $obat->id,
            'nama' => $obat->nama
        ])->values());

        const select = document.createElement('select');
        select.className = 'form-select';
        select.required = true;

        const awal = document.createElement('option');
        awal.value = '';
        awal.textContent = 'Pilih obat';
        select.appendChild(awal);

        pilihanObat.forEach(function(obat) {
            const option = document.createElement('option');
            option.value = obat.id;
            option.textContent = obat.nama;
            select.appendChild(option);
        });

        const kolomObat = document.createElement('div');
        kolomObat.className = 'col-md-5';
        const labelObat = document.createElement('label');
        labelObat.className = 'form-label';
        labelObat.textContent = 'Nama Obat';
        kolomObat.append(labelObat, select);

        const kolomJumlah = document.createElement('div');
        kolomJumlah.className = 'col-md-2';
        const labelJumlah = document.createElement('label');
        labelJumlah.className = 'form-label';
        labelJumlah.textContent = 'Jumlah';
        const inputJumlah = document.createElement('input');
        inputJumlah.type = 'number';
        inputJumlah.min = '1';
        inputJumlah.value = '1';
        inputJumlah.className = 'form-control';
        inputJumlah.required = true;
        kolomJumlah.append(labelJumlah, inputJumlah);

        const kolomDosis = document.createElement('div');
        kolomDosis.className = 'col-md-2';
        const labelDosis = document.createElement('label');
        labelDosis.className = 'form-label';
        labelDosis.textContent = 'Dosis';
        const inputDosis = document.createElement('input');
        inputDosis.className = 'form-control';
        inputDosis.placeholder = 'Contoh: 1 tablet';
        kolomDosis.append(labelDosis, inputDosis);

        const kolomAturan = document.createElement('div');
        kolomAturan.className = 'col-md-2';
        const labelAturan = document.createElement('label');
        labelAturan.className = 'form-label';
        labelAturan.textContent = 'Aturan pakai';
        const inputAturan = document.createElement('input');
        inputAturan.className = 'form-control';
        inputAturan.placeholder = 'Contoh: sesudah makan';
        kolomAturan.append(labelAturan, inputAturan);

        const kolomHapus = document.createElement('div');
        kolomHapus.className = 'col-md-1';
        const tombolHapus = document.createElement('button');
        tombolHapus.type = 'button';
        tombolHapus.className = 'btn btn-outline-danger w-100';
        tombolHapus.textContent = 'X';
        tombolHapus.onclick = () => baris.remove();
        kolomHapus.appendChild(tombolHapus);

        baris.append(kolomObat, kolomJumlah, kolomDosis, kolomAturan, kolomHapus);
        baris.dataset.index = jumlahBarisObat++;
        baris._resepFields = {
            obat: select,
            jumlah: inputJumlah,
            dosis: inputDosis,
            aturan: inputAturan
        };

        daftarObat.appendChild(baris);
    }

    document.getElementById('formDokter').addEventListener('submit', function(event) {
        if (!document.getElementById('pendaftaran_id').value) {
            event.preventDefault();
            alert('Pilih pasien terlebih dahulu dari tabel pendaftaran.');
            return;
        }

        const resep = Array.from(daftarObat.children).map(function(baris) {
            const fields = baris._resepFields;
            return {
                obat_id: fields.obat.value,
                jumlah: fields.jumlah.value,
                dosis: fields.dosis.value,
                aturan_pakai: fields.aturan.value
            };
        }).filter(item => item.obat_id && Number(item.jumlah) >= 1);

        document.getElementById('resep_obat').value = JSON.stringify(resep);
    });

    function resetFormDokter() {
        setTimeout(() => {
            daftarObat.innerHTML = '';
            document.getElementById('namaPasien').value = '';
            document.getElementById('namaDokter').value = '';
            document.getElementById('pendaftaran_id').value = '';
            document.getElementById('resep_obat').value = '[]';
        }, 0);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
