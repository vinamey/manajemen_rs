<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterPasienController;

Route::get('/', function () {
    return view('landing');
});

Route::resource('master-pasien', MasterPasienController::class);
@include('isabel.php');
