<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use Modules\Web\Controllers\LogController;
use Modules\Auth\Controllers\AuthController;
use Modules\System\Controllers\SystemController;

use Modules\Diplomas\Controllers\DiplomaController;
use Modules\Payments\Controllers\PaymentController;
use Modules\System\Controllers\SystemModelController;
use Modules\Dashboard\Controllers\DashboardController;
use Modules\Enrolments\Controllers\EnrolmentController;
use Modules\System\Controllers\SystemCommandController;

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

    // Route::resource('/system/models', SystemModelController::class);

    Route::prefix('/system')->group(function () {
        Route::get('/', SystemController::class);
        Route::resource('/models', SystemModelController::class);
        Route::get('/commands', [SystemCommandController::class, 'index']);
        Route::get('/commands/{command_id}/run', [SystemCommandController::class, 'run']);
        Route::get('/commands/{command_id}', [SystemCommandController::class, 'show']);
    });

    Route::prefix('/dashboards')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboards.index');
        Route::get('/marketing', [DashboardController::class, 'marketing'])
            ->name('dashboards.marketing');
    });
});
