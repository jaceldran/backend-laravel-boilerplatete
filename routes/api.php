<?php

// use App\Http\Controllers\Api\LoginController;
// use App\Http\Controllers\Api\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\Controllers\LoginController;
use Modules\Api\Controllers\LogoutController;

Route::post('/login', LoginController::class)->name('api.login');
Route::post('/logout', LogoutController::class)->name('api.logout');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
