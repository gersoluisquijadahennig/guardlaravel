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

    

});

Route::get('component/user/{layout?}', [UserController::class, 'ListUsers'])->name('user');


/**
 * Contenido Laravel
 */

Route::get('/user/{layout?}', [UserController::class, 'ListUsers'])->name('user');	

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/user-list', [UserController::class, 'ListUsers'])->name('user-list');

/**
 * login routes
 */

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

/**
 * users routes 
 */

Route::group(['middleware' => 'auth'], function () {
 
    Route::get('/user-add', [UserController::class, 'AddUser'])->name('user-add');
    Route::post('/user-save', [UserController::class, 'SaveUser'])->name('user-save');
    Route::get('/user-edit/{id}', [UserController::class, 'EditUser'])->name('user-edit');
    Route::post('/user-update/{id}', [UserController::class, 'UpdateUser'])->name('user-update');
    Route::get('/user-delete/{id}', [UserController::class, 'DeleteUser'])->name('user-delete');

});

Route::get('/datosListaUsuarios', [UserController::class, 'DatosListadoUsuarios'])->name('datosListaUsuarios');

