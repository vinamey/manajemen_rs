<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Login Rumah Sakit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background:#f5f5f5;">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center bg-primary text-white">

                    <h3>LOGIN</h3>
                    <small>Sistem Informasi Rumah Sakit</small>

                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">

                        @csrf

                        <div class="mb-3">

    <label>Password</label>

    <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Masukkan Password"
        required
    >

</div>


<button type="submit" class="btn btn-primary w-100">

    Login

</button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>