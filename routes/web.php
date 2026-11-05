<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// method
// get, post, put, delete

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');

Route::get('kurang', [BelajarController::class, 'pengurangan'])->name('kurang');
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');

Route::get('bagi', [BelajarController::class, 'pembagian'])->name('bagi');
Route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');

Route::get('kali', [BelajarController::class, 'perkalian'])->name('kali');
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}', [CatalogController::class, 'category'])->name('category.show');
Route::get('/product/{slug}', [CatalogController::class, 'product'])->name('product.show');
