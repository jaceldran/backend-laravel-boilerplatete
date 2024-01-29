<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakeSaleController;

Route::resource('sales', FakeSaleController::class);

Route::get('/', function () {
    return Inertia::render('Welcome');
});
