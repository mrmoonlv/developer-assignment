<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectricityController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // TODO: need to check about api route
    Route::group(['prefix' => '/api/v1/'], function () {
        Route::get('electricity-price', [ElectricityController::class, 'getElectricityPrice']);
    });
});
