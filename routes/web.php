<?php

use App\Exports\ExportLaporan;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LaporaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PembayaransController;
use App\Http\Controllers\PembeliansController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualansController;
use App\Http\Controllers\StokObatController;
use App\Http\Controllers\SuplierController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::group(['middleware' => ['role:admin']], function() {
   Route::get('/suplier',[SuplierController::class,'index'])->name('supliers');
   Route::post('/suplier/store',[SuplierController::class,'store'])->name('suplier.store');
   Route::post('/suplier/edits',[SuplierController::class,'edits'])->name('suplier.edits');
   Route::post('/suplier/updates',[SuplierController::class,'updates'])->name('suplier.updates');
   Route::post('/suplier/hapus',[SuplierController::class,'hapus'])->name('suplier.hapus');

   //obat
    Route::get('/obat',[ObatController::class,'index'])->name('obats');
    Route::post('/obat/store',[ObatController::class,'store'])->name('obat.store');
    Route::post('/obat/edits',[ObatController::class,'edits'])->name('obat.edits');
    Route::post('/obat/updates',[ObatController::class,'updates'])->name('obat.updates');
    Route::post('/obat/hapus',[ObatController::class,'hapus'])->name('obat.hapus');

    //stokobat
    Route::get('/stokobat',[StokObatController::class,'index'])->name('stokobats');
    Route::post('/stokobat/store',[StokObatController::class,'store'])->name('stokobat.store');
    Route::post('/stokobat/edits',[StokObatController::class,'edits'])->name('stokobat.edits');
    Route::post('/stokobat/updates',[StokObatController::class,'updates'])->name('stokobat.updates');
    Route::post('/stokobat/hapus',[StokObatController::class,'hapus'])->name('stokobat.hapus');


    // Route::post('/stokobat/getObat',[StokObatController::class,'getObat'])->name('getObat');
    // Route::post('/stokobat/getdataObat',[StokObatController::class,'getdataObat'])->name('getdataObat');


    //Penjualan
    // Route::get('/penjualan',[PenjualanController::class,'index'])->name('penjualans');
    // Route::post('/penjualan/store',[PenjualanController::class,'store'])->name('penjualan.store');
    // Route::post('/penjualan/edits',[PenjualanController::class,'edits'])->name('penjualan.edits');
    // Route::post('/penjualan/updates',[PenjualanController::class,'updates'])->name('penjualan.updates');
    // Route::post('/penjualan/hapus',[PenjualanController::class,'hapus'])->name('penjualan.hapus');
    // Route::resource('penjualans', PenjualanController::class);
    // Route::get('penjualan.dataTable',[PenjualanController::class,'dataTable'])->name('penjualan.dataTable');

    Route::resource('penjualans', PenjualansController::class);
    Route::get('penjualans.dataTable',[PenjualansController::class,'dataTable'])->name('penjualans.dataTable');
    Route::post('penjualans.hapus',[PenjualansController::class,'hapusOrder'])->name('hapusOrder');
    Route::post('penjualans.cetak',[PenjualansController::class,'cetakNota'])->name('cetakNota');


    //pembayaran
    Route::post('pembayarans.store',[PembayaransController::class,'store'])->name('simpanPenjualan');
    // Route::post('penjulalan.cetak',[PenjualansController::class,'cetakNota'])->name('cetakNota');


    //PembelianController

    Route::get('/belanja',[PembeliansController::class,'index'])->name('belanja');
    Route::post('/belanja/store',[PembeliansController::class,'store'])->name('belanja.store');
    Route::post('/belanja/edits',[PembeliansController::class,'edits'])->name('belanja.edits');
    Route::post('/belanja/updates',[PembeliansController::class,'updates'])->name('belanja.updates');
    Route::post('/belanja/hapus',[PembeliansController::class,'hapus'])->name('belanja.hapus');
    Route::get('/belanja/dataTable',[PembeliansController::class,'dataTable'])->name('belanja.dataTable');
    Route::post('/belanja/bayar',[PembeliansController::class,'bayar'])->name('belanja.bayar');
    // Route::resource('belanja', BelanjaController::class);

    //laporan

    Route::get('/laporan',[LaporaController::class,'index'])->name('laporan');
    Route::get('/laporan/dataTablePenjualan',[LaporaController::class,'dataTablePenjualan'])->name('dataTablePenjualan');
    Route::get('/laporan/dataTablePembelian',[LaporaController::class,'dataTablePembelian'])->name('dataTablePembelian');

    Route::get('/exportlaporan',[ExportController::class,'laporan'])->name('exportlaporan');
    Route::get('/exportpembelian',[ExportController::class,'pembelian'])->name('exportpembelian');

    Route::get('laporan/records', [LaporaController::class, 'records'])->name('laporan.records');
});
require __DIR__.'/auth.php';
