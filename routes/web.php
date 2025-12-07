<?php

use App\Http\Controllers\MasterTeknisiController;



use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('master-teknisi.index');
});

Route::resource('master-teknisi', MasterTeknisiController::class);
