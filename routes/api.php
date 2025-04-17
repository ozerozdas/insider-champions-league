<?php

use App\Http\Controllers\Api\SimulationController;
use Illuminate\Support\Facades\Route;

Route::post('/simulate-all', [SimulationController::class, 'simulateAll']);
Route::post('/simulate-next', [SimulationController::class, 'simulateNext']);
Route::post('/reset', [SimulationController::class, 'reset']);