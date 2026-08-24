<!DOCTYPE html>
<html>
<head>

    <title>Role Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>Role Management</h3>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-3 d-flex gap-2">

    <a href="{{ route('superadmin.dashboard') }}"
       class="btn btn-secondary">
        ← Dashboard
    </a>

    <a href="{{ route('roles.create') }}"
       class="btn btn-success">
        + Tambah Role
    </a>

</div>

            <table class="table table-bordered">

                <thead class="table-dark">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Role</th>
                        <th width="280">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($roles as $role)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $role->name }}</td>

                        <td>

                            <a href="{{ route('roles.edit',$role->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="{{ route('roles.permission',$role->id) }}"
                               class="btn btn-info btn-sm">
                                Permission
                            </a>

                            <form action="{{ route('roles.destroy',$role->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus role ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center">
                            Tidak ada data role.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>