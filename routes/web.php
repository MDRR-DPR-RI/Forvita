<?php

use App\Models\RUU;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RUUController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/kelompok1');
Route::get('/kelompok1', function () {
    return view('dashboard.contents.kelompok1', [
        'active' => 'kelompok1',
    ]);
});
Route::resource('/kelompok23', RUUController::class);

Route::get('/kelompok46', function () {
    return view('dashboard.contents.kelompok46', [
        'active' => 'kelompok46',
    ]);
});
Route::get('/kelompok5', function () {
    return view('dashboard.contents.kelompok5', [
        'active' => 'kelompok5',
    ]);
});
