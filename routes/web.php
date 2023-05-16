<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('laporan');
// });

Auth::routes();

Route::resource('laporan', LaporanController::class);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
