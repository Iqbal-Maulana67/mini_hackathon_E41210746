<?php

use App\Http\Controllers\ApiLaporanPanenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('api_laporan', [ApiLaporanPanenController::class, 'getAll']);
Route::get('api_laporan/{id}', [ApiLaporanPanenController::class, 'getSpecData']);
Route::post('api_laporan', [ApiLaporanPanenController::class, 'createData']);
Route::put('api_laporan/{id}', [ApiLaporanPanenController::class, 'updateData']);
Route::delete('api_laporan/{id}', [ApiLaporanPanenController::class, 'deleteData']);

