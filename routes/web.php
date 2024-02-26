<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

/**
 * hacer prefix "component" para que todas las rutas de componentes funcionen con auth:sanctum
 * este contenido solo para panel porque usa auth:sanctum
 */

Route::prefix('component')->middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', [UserController::class, 'ListUsers'])->name('user');

});
/**
 * Contenido Laravel
 */



Route::get('/user/{layout?}', [UserController::class, 'ListUsers'])->name('user');	

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/user-list', [UserController::class, 'ListUsers'])->name('user-list');

