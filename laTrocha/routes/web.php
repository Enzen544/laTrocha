<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('combustible', \App\Http\Controllers\CombustibleController::class);
    Route::resource('fiados', \App\Http\Controllers\FiadoController::class);
    Route::resource('bodega', \App\Http\Controllers\BodegaController::class);
    Route::resource('lavadas', \App\Http\Controllers\LavadaController::class);
    Route::get('/reportes',[\App\Http\Controllers\ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/pdf', [\App\Http\Controllers\ReporteController::class, 'exportPdf'])->name('reportes.pdf');
    Route::get('/reportes/excel', [\App\Http\Controllers\ReporteController::class, 'exportExcel'])->name('reportes.excel');
});



