<?php

use App\Http\Controllers\MasterTeknisiController;
use App\Http\Controllers\MasterLokasiController;
use App\Http\Controllers\KategoriPekerjaanController;


use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('master-teknisi.index');
});

Route::resource('master-teknisi', MasterTeknisiController::class);
Route::resource('master-lokasi', MasterLokasiController::class);
Route::resource('kategori-pekerjaan', KategoriPekerjaanController::class);