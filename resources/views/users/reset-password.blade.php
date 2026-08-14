<!DOCTYPE html>
<html>

<head>

    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Reset Password User</h4>

</div>

<div class="card-body">

<form action="{{ route('users.reset-password.update',$user->id) }}" method="POST">

@csrf

<div class="mb-3">

<label>Nama</label>

<input
type="text"
class="form-control"
value="{{ $user->name }}"
readonly>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="text"
class="form-control"
value="{{ $user->email }}"
readonly>

</div>

<div class="mb-3">

<label>Password Baru</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="password_confirmation"
class="form-control"
required>

</div>

<button class="btn btn-primary">

Reset Password

</button>

<a href="{{ route('users.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>