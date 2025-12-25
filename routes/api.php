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
    // Pastikan menggunakan POST untuk logout dan GET/POST untuk me
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

/*
|--------------------------------------------------------------------------
| PELAYANAN (CUCI SEPATU)
|--------------------------------------------------------------------------
*/

// PUBLIC (Poin 2a & 2b tugas)
Route::get('/pelayanans', [PelayananController::class, 'index']);
Route::get('/pelayanans/{id}', [PelayananController::class, 'show']);

// PROTECTED (Poin 2c, 2d, 2e tugas)
Route::middleware('auth:api')->group(function () {
    Route::post('/pelayanans', [PelayananController::class, 'store']);
    
    // TIPS: Gunakan POST untuk Update jika mengirim File, 
    // nanti di Postman kita manipulasi dengan _method = PUT
    Route::patch('/pelayanans/{id}', [PelayananController::class, 'update']); 
    
    Route::delete('/pelayanans/{id}', [PelayananController::class, 'destroy']);
});