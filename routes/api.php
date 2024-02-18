<?php

use App\Http\Controllers\LaporaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenjualansController;
use App\Http\Controllers\StokObatController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getObat',[StokObatController::class,'getObat'])->name('getObat');
Route::post('getdataObat',[StokObatController::class,'getdataObat'])->name('getdataObat');
Route::post('hitung',[PenjualansController::class,'hitung'])->name('hitung');
Route::post('carikode',[ObatController::class,'getkode'])->name('carikode');
Route::get('detailjual',[LaporaController::class,'detailJual'])->name('detailjual');
Route::get('detailbeli',[LaporaController::class,'detailBeli'])->name('detailbeli');
