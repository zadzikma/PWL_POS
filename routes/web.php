<?php


use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/create_ajax', [UserController::class, 'createAjax']);
    Route::post('/ajax', [UserController::class, 'storeAjax']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::get('/{id}/edit_ajax', [UserController::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [UserController::class, 'updateAjax']);
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});


Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
    Route::post('/ajax', [LevelController::class, 'store_ajax']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'editAjax']);
    Route::put('/{id}/update_ajax', [LevelController::class, 'updateAjax']);
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirmAjax']);
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'deleteAjax']);
    Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'destroy_ajax']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});



Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/list', [KategoriController::class, 'list']);
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});


Route::prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/list', [SupplierController::class, 'list']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/{id}', [SupplierController::class, 'update']);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/list', [BarangController::class, 'list'])->name('barang.list');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});
