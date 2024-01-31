<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FakeSaleController;
use App\Http\Controllers\DashboardController;

Route::resource('sales', FakeSaleController::class);

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', function () {
    return redirect('/dashboards');
    // return Inertia::render('Welcome');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboards/marketing', [DashboardController::class, 'marketing'])
        ->name('dashboards.marketing');
    Route::get('/dashboards', [DashboardController::class, 'index'])
        ->name('dashboards.index');
});
