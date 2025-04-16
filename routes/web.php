<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->name('home');

Route::group(['prefix' => 'simulation'], function () {
    Route::post('/start', [SimulationController::class, 'start'])
        ->name('simulation.start');

    Route::get('/dashboard', [SimulationController::class, 'index'])
        ->name('simulation.dashboard');
});
