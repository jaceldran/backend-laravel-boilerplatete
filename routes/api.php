<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
