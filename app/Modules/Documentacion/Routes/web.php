<?php

use App\Mail\CorreoPrueba;
use App\Modules\Documentacion\Controllers\PoliticaController;
use App\Modules\Documentacion\Controllers\PoliticaFirma;
use App\Modules\Documentacion\Controllers\PoliticaUsuarioController;
use App\Modules\Documentacion\Controllers\PoliticaVersionController;

Route::group(['prefix' => 'documentacion','middleware' => 'web'], function () {
    Route::get('/politica', [PoliticaController::class, 'index'])->name('politica.index');
    Route::get('/politica/editar/{id}', [PoliticaController::class, 'editarPolitica'])->name('politica.editarPolitica');
    Route::put('/politica/editar/{id}', [PoliticaController::class, 'actualizarPolitica'])->name('politica.actualizarPolitica');
    Route::get('/politica/crear', [PoliticaController::class, 'crearPolitica'])->name('politica.crearPolitica');
    Route::post('/politica/crear', [PoliticaController::class, 'guardarPolitica'])->name('politica.guardarPolitica');
    Route::delete('/politica/eliminar/{id}', [PoliticaController::class, 'eliminarPolitica'])->name('politica.eliminarPolitica');


    Route::get('/politica/version', [PoliticaVersionController::class, 'index'])->name('politica-version.index');

    Route::get('/politica/usuario', [PoliticaUsuarioController::class, 'index'])->name('politica-usuario.index');
    
    
});


Route::group(['prefix' => 'servicio','middleware' => ['web']], function () {
    Route::get('/firma/{token}', [PoliticaFirma::class, 'indexWebSite'])->name('firma-politica.indexWebSite');
    Route::post('/firmar', [PoliticaFirma::class, 'firmarPoliticasWebSite'])->name('firmar-politicas.firmarPoliticasWebSite');
});

Route::group(['prefix' => 'documentacion','middleware' => ['web','auth']], function () {
    Route::get('/firma', [PoliticaFirma::class, 'index'])->name('firma-politica.index');
    Route::post('/firmar', [PoliticaFirma::class, 'firmarPoliticas'])->name('firmar-politicas.firmarPoliticas');
});



/**
 * convencion para el nombre de las rutas, se debe usar el nombre del modulo, seguido de un guion nombre del controlador seguido de un guion nombre de la funcion
 * ejemplo: modulo-controlador-funcion
 * 
 */