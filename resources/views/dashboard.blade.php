<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-body">

            <h2>Selamat Datang</h2>

            <h4>{{ auth()->user()->name }}</h4>

            <p>{{ auth()->user()->email }}</p>

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