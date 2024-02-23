<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserPanelController;
use App\Http\Controllers\Api\Auth\ApiLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/api-login', [ApiLoginController::class, 'login'])->name('api-login');

Route::get('api-users', [UserPanelController::class, 'ListUsersPanel'])->middleware('auth:sanctum')->name('api-users');
//Route::get('/api-users', [UserPanelController::class, 'ListUsersPanel'])->name('api-users');



