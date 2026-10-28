<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;

Route::prefix('admin/fasilitas')->name('fasilitas.')->group(function () {
    Route::get('/', [RuanganController::class, 'index'])->name('index');
    Route::get('/tambah', [RuanganController::class, 'create'])->name('create');
    Route::post('/tambah', [RuanganController::class, 'store'])->name('store');
    Route::get('/update/{id}', [RuanganController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [RuanganController::class, 'update'])->name('update');
    Route::delete('/hapus/{id}', [RuanganController::class, 'destroy'])->name('destroy');
});