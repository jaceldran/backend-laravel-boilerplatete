<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use Modules\Web\Controllers\LogController;

use Modules\Auth\Controllers\AuthController;
use Modules\Diplomas\Controllers\DiplomaController;
use Modules\Payments\Controllers\PaymentController;
use Modules\Dashboard\Controllers\DashboardController;
use Modules\Enrolments\Controllers\EnrolmentController;

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
