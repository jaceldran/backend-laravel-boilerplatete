<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use Modules\Web\Controllers\LogController;
use Modules\Web\Controllers\AuthController;
use Modules\Web\Controllers\DiplomaController;
use Modules\Web\Controllers\PaymentController;
use Modules\Web\Controllers\FakeSaleController;
use Modules\Web\Controllers\DashboardController;
use Modules\Web\Controllers\EnrolmentController;

Route::resource('sales', FakeSaleController::class);

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/enrolments', EnrolmentController::class);
    Route::resource('/payments', PaymentController::class);
    Route::get('/diplomas', DiplomaController::class);
    Route::get('/logs', LogController::class);

    Route::prefix('/dashboards')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboards.index');
        Route::get('/marketing', [DashboardController::class, 'marketing'])
            ->name('dashboards.marketing');
    });
});
