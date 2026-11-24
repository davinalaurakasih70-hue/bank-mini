<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('nasabah', NasabahController::class);
