<?php
use App\Modules\AsistenteEducacion\Controllers\MvSolicitudEstabController;


Route::group(['prefix' => 'asistente','middleware' => ['web']], function () {
    Route::get('/solicitud/create/', [MvSolicitudEstabController::class, 'create'])->name('asistente.solicitud.create');
});