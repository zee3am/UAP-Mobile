<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelayananController;

Route::get('/pelayanan', [PelayananController::class, 'index']);
Route::get('/pelayanan/{id}', [PelayananController::class, 'show']);
Route::post('/pelayanan', [PelayananController::class, 'store']);
Route::put('/pelayanan/{id}', [PelayananController::class, 'update']);
Route::delete('/pelayanan/{id}', [PelayananController::class, 'destroy']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
