<?php

use App\Http\Controllers\PeminjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/peminjam', [PeminjamController::class, 'peminjamview']);

Route::get('/addpeminjam', [PeminjamController::class, 'addPeminjamView']);
Route::post('/insertpeminjam', [PeminjamController::class, 'insertPeminjam']);

Route::get('/editpeminjam/{peminjam_id}', [PeminjamController::class, 'editpeminjamview']);
Route::post('/updatepeminjam/{peminjam_id}', [PeminjamController::class, 'updatepeminjam']);

Route::get('/deletepeminjam/{peminjam_id}', [PeminjamController::class, 'deletePeminjam']);
