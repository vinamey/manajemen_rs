    @extends('layouts.superadmin')
    @section('page-title', 'Dashboard Master Supplier')

    @section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid p-4" style="background-color: #f8fafc; min-height: 100vh;">
    
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 rounded-4 d-flex align-items-center justify-content-center" style="background-color: #e0edff; color: #1d72f3; width: 48px; height: 48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 2.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1zM2.5 5A1.5 1.5 0 0 0 1 6.5v7A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 5h-11z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">Data Supplier</h3>
                    <small class="text-muted">Data supplier yang terdaftar</small>
                </div>
            </div>

            <button type="button" class="btn text-white fw-medium px-4 py-2.5 rounded-3 border-0" style="background-color: #1d72f3;" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">
                + Tambah Supplier
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr style="background-color: #1d72f3 !important; color: #ffffff !important;">
                            <th class="py-3 px-4 text-center border-0" style="background-color: #1d72f3 !important; color: #ffffff !important; width: 60px;">No</th>
                            <th class="py-3 px-4 border-0" style="background-color: #1d72f3 !important; color: #ffffff !important;">Kode Supplier</th>
                            <th class="py-3 px-4 border-0" style="background-color: #1d72f3 !important; color: #ffffff !important;">Nama Supplier</th>
                            <th class="py-3 px-4 text-center border-0" style="background-color: #1d72f3 !important; color: #ffffff !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($suppliers as $supplier)
    <tr>
        <td class="py-3 px-4 text-center text-muted">{{ $loop->iteration }}</td>
        
        <!-- KODE SUPPLIER (Badge Biru) -->
        <td class="py-3 px-4">
            <span class="badge rounded-3 px-3 py-2 fw-bold" style="background-color: #e0edff; color: #1d72f3; font-size: 13px;">
                {{ $supplier->kode }}
            </span>
        </td>

        <!-- NAMA SUPPLIER (Badge Orange/Krem) -->
        <td class="py-3 px-4">
            <span class="badge rounded-3 px-3 py-2 fw-bold" style="background-color: #ffedd5; color: #ea580c; font-size: 13px;">
                {{ $supplier->nama }}
            </span>
        </td>

        <td class="py-3 px-4 text-center text-nowrap">
            <div class="d-inline-flex gap-1">
                <button type="button" class="btn btn-sm border-0 px-3 py-2 rounded-2 d-flex flex-column align-items-center fw-medium" style="background-color: #e0f2fe; color: #0284c7; min-width: 55px;" 
                    onclick="openDetailModal('{{ $supplier->kode }}', '{{ $supplier->nama }}')">
                    <span>👁</span> <small style="font-size: 11px;">Lihat</small>
                </button>

                <button type="button" class="btn btn-sm text-white border-0 px-3 py-2 rounded-2 d-flex flex-column align-items-center fw-medium" style="background-color: #1d72f3; min-width: 55px;" 
                    onclick="openEditModal('{{ $supplier->id }}', '{{ $supplier->kode }}', '{{ $supplier->nama }}', '{{ route('master-supplier.update', $supplier->id) }}')">
                    <span>✏️</span> <small style="font-size: 11px;">Edit</small>
                </button>

                <button type="button" class="btn btn-sm text-white border-0 px-3 py-2 rounded-2 d-flex flex-column align-items-center fw-medium btn-hapus-supplier" style="background-color: #ef4444; min-width: 55px;" 
                    data-nama="{{ $supplier->nama }}" 
                    data-url="{{ route('master-supplier.destroy', $supplier->id) }}">
                    <span>🗑</span> <small style="font-size: 11px;">Hapus</small>
                </button>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center py-5 text-muted">Belum ada data supplier.</td>
    </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>


<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

            <div class="modal-header text-white border-0 px-4 py-3"
                 style="background-color: #1d72f3;">

                <h5 class="modal-title fw-bold">
                    Tambah Supplier
                </h5>

              
            </div>

            <form id="formTambahSupplier"
                  action="{{ route('master-supplier.store') }}"
                  method="POST">

                @csrf
                <div class="modal-body py-4 px-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">
                                Kode Supplier
                                <span class="text-danger"></span>
                            </label>

                            <input type="text"
                                   name="kode"
                                   class="form-control rounded-3 py-2 px-3"
                                   placeholder="Contoh: SUP01"
                                   required
                                      style="background-color: #1d72f3;">
                              
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">
                                Nama Supplier
                                <span class="text-danger"></span>
                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control rounded-3 py-2 px-3"
                                   placeholder="Nama"
                                   required>
                        </div>

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 pt-0 px-4 pb-4">

                    <button type="button"
                            class="btn btn-light fw-medium px-4 py-2 rounded-3 border"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            id="btnSimpan"
                            class="btn text-white fw-medium px-4 py-2 rounded-3 border-0"
                            style="background-color: #1d72f3;">
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


    <div class="modal fade" id="modalEditSupplier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

            <div class="modal-header text-white border-0 px-4 py-3"
                 style="background-color: #1d72f3;">

                    <h5 class="modal-title fw-bold text-dark">Edit Supplier</h5>
                </div>
                <form id="formEditSupplier" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body py-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-dark">Kode Supplier <span class="text-danger"></span></label>
                                <input type="text" id="edit_kode" name="kode" class="form-control rounded-3 py-2 px-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-dark">Nama Supplier <span class="text-danger"></span></label>
                                <input type="text" id="edit_nama" name="nama" class="form-control rounded-3 py-2 px-3" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light fw-medium px-4 py-2 rounded-3 border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnUpdate" class="btn text-white fw-medium px-4 py-2 rounded-3 border-0" style="background-color: #1d72f3;">
                            Update Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


  <div class="modal fade" id="modalDetailSupplier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

            <div class="modal-header text-white border-0 px-4 py-3"
                 style="background-color: #1d72f3;">

                <h5 class="modal-title fw-bold">
                    Detail Supplier
                </h5>
            </div>

            <div class="modal-body py-4 px-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark">
                            Kode Supplier
                        </label>
                        <input type="text"
                               id="detail_kode"
                               class="form-control rounded-3 py-2 px-3"
                               readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark">
                            Nama Supplier
                        </label>
                        <input type="text"
                               id="detail_nama"
                               class="form-control rounded-3 py-2 px-3"
                               readonly>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                  <button type="button"
                        class="btn text-white fw-medium px-4 py-2 rounded-3 border-0"
                        style="background-color: #1d72f3;"
                        data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

        </div>
    </div>
</div>

    <div class="modal fade" id="modalHapusSupplier" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            
                <div class="modal-header text-white border-0 py-3 px-4" style="background-color: #e11d48;">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Konfirmasi Hapus
                    </h5>
                </div>
                
                <div class="modal-body text-center py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3" style="color: #e11d48;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </div>
                    <p class="fs-5 text-dark mb-0">
                        Apakah kamu yakin ingin menghapus data supplier <strong id="hapus_nama_supplier"></strong> ?
                    </p>
                </div>

                <div class="modal-footer border-0 pb-4 justify-content-center gap-2">
                    <button type="button" class="btn btn-light fw-medium px-4 py-2 rounded-3 border" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" id="btnProsesHapus" class="btn text-white fw-medium px-4 py-2 rounded-3 border-0 d-flex align-items-center gap-2" style="background-color: #e11d48;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openDetailModal(kode, nama) {
        document.getElementById('detail_kode').value = kode;
        document.getElementById('detail_nama').value = nama;
        
        let modal = new bootstrap.Modal(document.getElementById('modalDetailSupplier'));
        modal.show();
    }

    function openEditModal(id, kode, nama, updateUrl) {
        document.getElementById('edit_kode').value = kode;
        document.getElementById('edit_nama').value = nama;
        let form = document.getElementById('formEditSupplier');
        form.action = updateUrl;
        
        let modal = new bootstrap.Modal(document.getElementById('modalEditSupplier'));
        modal.show();
    }

    document.getElementById('formTambahSupplier').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        let btn = document.getElementById('btnSimpan');
        btn.disabled = true; btn.innerText = 'Menyimpan...';

        fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: new FormData(form)
        })
        .then(async res => {
            let data = await res.json();
            if (!res.ok) throw data;
            return data;
        })
        .then(data => {
            bootstrap.Modal.getInstance(document.getElementById('modalTambahSupplier')).hide();
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, confirmButtonColor: '#1d72f3' })
                .then(() => location.reload());
        })
        .catch(error => {
            btn.disabled = false; btn.innerText = 'Simpan Data';
            let msg = error.errors ? Object.values(error.errors).flat().join('<br>') : (error.message || 'Terjadi kesalahan.');
            Swal.fire({ icon: 'error', title: 'Oops...', html: msg, confirmButtonColor: '#1d72f3' });
        });
    });

    document.getElementById('formEditSupplier').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        let btn = document.getElementById('btnUpdate');
        btn.disabled = true; btn.innerText = 'Updating...';

        fetch(form.action, {
            method: 'POST',
            headers: { 
                'X-Requested-With': 'XMLHttpRequest', 
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: new FormData(form)
        })
        .then(async res => {
            let contentType = res.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return { data: await res.json(), status: res.status };
            } else {
                throw new Error("Server mengembalikan respon error.");
            }
        })
        .then(({ data, status }) => {
            if (status === 200 || data.success) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditSupplier')).hide();
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, confirmButtonColor: '#1d72f3' })
                    .then(() => location.reload());
            } else {
                throw data;
            }
        })
        .catch(error => {
            btn.disabled = false; btn.innerText = 'Update Data';
            let msg = error.errors ? Object.values(error.errors).flat().join('<br>') : (error.message || 'Terjadi kesalahan.');
            Swal.fire({ icon: 'error', title: 'Oops...', html: msg, confirmButtonColor: '#1d72f3' });
        });
    });

    let deleteTargetUrl = '';

    document.addEventListener('click', function (e) {
        let btn = e.target.closest('.btn-hapus-supplier');
        if (btn) {
            deleteTargetUrl = btn.getAttribute('data-url');
            let namaSupplier = btn.getAttribute('data-nama');
            
            document.getElementById('hapus_nama_supplier').innerText = namaSupplier;
            
            let modalEl = document.getElementById('modalHapusSupplier');
            let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
        }
    });

    document.getElementById('btnProsesHapus').addEventListener('click', function() {
        let btn = this;
        btn.disabled = true;
        btn.innerText = 'Menghapus...';

        fetch(deleteTargetUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        })
        .then(async res => {
            let data = await res.json();
            if (!res.ok) throw data;
            return data;
        })
        .then(data => {
            let modalEl = document.getElementById('modalHapusSupplier');
            let modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            Swal.fire({ 
                icon: 'success', 
                title: 'Terhapus!', 
                text: data.message, 
                confirmButtonColor: '#1d72f3' 
            }).then(() => location.reload());
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg> Ya, Hapus`;
            
            let msg = error.message ? error.message : 'Terjadi kesalahan saat menghapus data.';
            Swal.fire({ 
                icon: 'error', 
                title: 'Gagal Hapus', 
                text: msg, 
                confirmButtonColor: '#1d72f3' 
            });
        });
    });
    </script>
    @endsection