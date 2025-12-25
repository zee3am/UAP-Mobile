<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelayananController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

/*
|--------------------------------------------------------------------------
| PELAYANAN (CUCI SEPATU)
|--------------------------------------------------------------------------
*/

// PUBLIC
Route::get('/pelayanans', [PelayananController::class, 'index']);
Route::get('/pelayanans/{id}', [PelayananController::class, 'show']);

// PROTECTED
Route::middleware('auth:api')->group(function () {
    Route::post('/pelayanans', [PelayananController::class, 'store']);
    Route::put('/pelayanans/{id}', [PelayananController::class, 'update']);
    Route::delete('/pelayanans/{id}', [PelayananController::class, 'destroy']);
});
