<?php

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
