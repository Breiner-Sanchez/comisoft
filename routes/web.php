<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\SolicitudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|*/

Route::get('/', function () {
    return redirect()->route('actas.index');
});

Auth::routes();

// Rutas Protegidas
Route::middleware('auth')->group(function () {
    // Rutas de Solicitudes
    Route::resource('solicitudes', SolicitudController::class);
    Route::post('solicitudes/{solicitud}/reject', [SolicitudController::class, 'reject'])->name('solicitudes.reject');
    
    // Rutas de Actas
    Route::resource('actas', ActaController::class);
    Route::get('actas/create/{solicitud}', [ActaController::class, 'createFromSolicitud'])->name('actas.create.solicitud');
    Route::get('actas/{acta}/pdf', [ActaController::class, 'pdf'])->name('actas.pdf');
    Route::get('fichas/{id}/aprendices', [ActaController::class, 'aprendices']);
    
    // Rutas de Fichas
    Route::resource('fichas', FichaController::class);
    Route::get('fichas/{ficha}/aprendices/create', [FichaController::class, 'createAprendiz'])->name('fichas.aprendices.create');
    Route::post('fichas/{ficha}/aprendices', [FichaController::class, 'storeAprendiz'])->name('fichas.aprendices.store');
    Route::delete('aprendices/{aprendiz}', [FichaController::class, 'destroyAprendiz'])->name('aprendices.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
