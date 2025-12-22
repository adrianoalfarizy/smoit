<?php

use App\Http\Controllers\MasterTeknisiController;
use App\Http\Controllers\MasterLokasiController;
use App\Http\Controllers\KategoriPekerjaanController;
use App\Http\Controllers\MdrController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\SparepartTransaksiController;


use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('master-teknisi.index');
});
Route::resource('mdr', MdrController::class);
Route::get('mdr-export/pdf', [MdrController::class, 'exportPdf'])->name('mdr.export.pdf');
Route::get('mdr-export/excel', [MdrController::class, 'exportExcel'])->name('mdr.export.excel');

Route::resource('master-teknisi', MasterTeknisiController::class);
Route::resource('master-lokasi', MasterLokasiController::class);
Route::resource('kategori-pekerjaan', KategoriPekerjaanController::class);

Route::resource('sparepart', SparepartController::class);
Route::resource('sparepart-transaksi', SparepartTransaksiController::class)->only(['index']);