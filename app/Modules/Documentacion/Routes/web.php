<?php

use App\Modules\Documentacion\Controllers\PoliticaController;
use App\Modules\Documentacion\Controllers\FirmaPoliticaWebSite;
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
    Route::get('/politica/usuario/obtener/{id?}', [FirmaPoliticaWebSite::class, 'obtenerFirmaPolitica'])->name('obtener-politica-usuario.index');
});


Route::group(['prefix' => 'firma','middleware' => 'web'], function () {
    Route::get('/firma', [FirmaPoliticaWebSite::class, 'index'])->name('firma-politica.index');

});