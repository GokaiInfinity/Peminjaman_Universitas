<?php

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\RuangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Peminjam
Route::get('/peminjam', [PeminjamController::class, 'peminjamview']);

Route::get('/addpeminjam', [PeminjamController::class, 'addPeminjamView']);
Route::post('/insertpeminjam', [PeminjamController::class, 'insertPeminjam']);

Route::get('/editpeminjam/{peminjam_id}', [PeminjamController::class, 'editpeminjamview']);
Route::post('/updatepeminjam/{peminjam_id}', [PeminjamController::class, 'updatepeminjam']);

Route::get('/deletepeminjam/{peminjam_id}', [PeminjamController::class, 'deletePeminjam']);

// Peralatan
Route::get('/peralatan', [PeralatanController::class, 'peralatanview']);

Route::get('/addperalatan', [PeralatanController::class, 'addPeralatanView']);
Route::post('/insertperalatan', [PeralatanController::class, 'insertPeralatan']);

Route::get('/editperalatan/{peralatan_id}', [PeralatanController::class, 'editperalatanview']);
Route::post('/updateperalatan/{peralatan_id}', [PeralatanController::class, 'updateperalatan']);

Route::get('/deleteperalatan/{peralatan_id}', [PeralatanController::class, 'deletePeralatan']);

// Ruang
Route::get('/ruang', [RuangController::class, 'ruangview']);

Route::get('/addruang', [RuangController::class, 'addRuangView']);
Route::post('/insertruang', [RuangController::class, 'insertRuang']);

Route::get('/editruang/{ruang_id}', [RuangController::class, 'editruangview']);
Route::post('/updateruang/{ruang_id}', [RuangController::class, 'updateruang']);

Route::get('/deleteruang/{ruang_id}', [RuangController::class, 'deleteRuang']);

// Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'create']);

Route::post('/peminjaman/store', [PeminjamanController::class, 'store']);

Route::get('/peminjaman/viewpeminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

Route::get('/peminjaman/detail/{peminjaman_id}', [PeminjamanController::class, 'detail'])->name('peminjaman.detail');


// Peminjaman di terima
Route::post('/peminjaman/terima/{peminjaman_id}', [PeminjamanController::class, 'terima'])->name('peminjaman.terima');

// Peminjaman di tolak
Route::post('/peminjaman/tolak/{peminjaman_id}', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');

// Pengembalian
Route::post('/peminjaman/kembalikan/{peminjaman_id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembali');

Route::get('/peminjaman/export/excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.excel');
Route::get('/peminjaman/export/pdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.pdf');
