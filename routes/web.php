<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
     Route::get('/', [ReporteController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //rutas para eventos
    Route::get('/eventos', [EventoController::class, 'index'])->name('evento.index');
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('evento.create');
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('evento.show');
    Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('evento.edit');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('evento.update');
    Route::post('/eventos/create', [EventoController::class, 'store'])->name('evento.store');
    Route::delete('/eventos/{evento}/destroy', [EventoController::class, 'destroy'])->name('evento.destroy');
    Route::post('/eventos/{evento}/participar', [ParticipanteController::class, 'store'])
         ->name('participante.store');
         
         Route::put('/eventos/{evento}/participacion', [ParticipanteController::class, 'update'])
     
         ->name('participante.update');
         Route::get('/reporte/eventos', [EventoController::class, 'reporteEventos'])->name('reporte.eventos');

         // Ruta para el reporte de participación
         Route::get('/reporte/participacion', [EventoController::class, 'reporteParticipacion'])->name('reporte.participacion');    
         Route::get('/reporte', function () {
          return view('reportes.index');
      })->name('reporte.index');
    Route::delete('/eventos/{evento}/participacion', [ParticipanteController::class, 'destroy'])
         ->name('participante.destroy');
    //rutas para participantes
    Route::get('/mis-participaciones', [ParticipanteController::class, 'index'])->name('participante.index');
    Route::post('/participante/{evento}/create', [ParticipanteController::class, 'store'])->name('participante.store');
    Route::delete('/participante/{evento}/destroy', [ParticipanteController::class, 'destroy'])->name('participante.destroy');

});
require __DIR__.'/auth.php';
