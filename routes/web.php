<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
Route::get('/', function () {
    return view('welcome');
});

//method 
//get, post, put, delete

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');

Route::get('kurang', [BelajarController::class, 'pengurangan'])->name('kurang');
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');

Route::get('bagi', [BelajarController::class, 'pembagian'])->name('bagi');
Route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');

Route::get('kali', [BelajarController::class, 'perkalian'])->name('kali');
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');

