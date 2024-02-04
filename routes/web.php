<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\FakeSaleController;
use App\Http\Controllers\DashboardController;

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

    Route::prefix('/dashboards')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboards.index');
        Route::get('/marketing', [DashboardController::class, 'marketing'])
            ->name('dashboards.marketing');
    });

});
