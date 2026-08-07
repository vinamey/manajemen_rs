<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Super Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header bg-primary text-white">
            Dashboard Super Admin
        </div>

        <div class="card-body">

            <h3>Selamat Datang</h3>

            <h4>{{ auth()->user()->name }}</h4>

            <p>{{ auth()->user()->email }}</p>

            <p>Role :
                {{ auth()->user()->getRoleNames()->first() }}
            </p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">
                    Logout
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>