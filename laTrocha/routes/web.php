<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FiadoController;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fiados
    Route::get('/fiados', [FiadoController::class, 'index'])->name('fiados.index');
    Route::post('/fiados', [FiadoController::class, 'store'])->name('fiados.store');
    Route::post('/fiados/entidades', [FiadoController::class, 'storeEntidad'])->name('fiados.entidades.store');
    Route::delete('/fiados/entidades/{id}', [FiadoController::class, 'destroy'])->name('fiados.entidades.destroy');

    Route::resource('combustible', \App\Http\Controllers\CombustibleController::class);
    Route::resource('bodega', \App\Http\Controllers\BodegaController::class);
    Route::resource('lavadas', \App\Http\Controllers\LavadaController::class);
    Route::get('/reportes', [\App\Http\Controllers\ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/pdf', [\App\Http\Controllers\ReporteController::class, 'exportPdf'])->name('reportes.pdf');
    Route::get('/reportes/excel', [\App\Http\Controllers\ReporteController::class, 'exportExcel'])->name('reportes.excel');
});