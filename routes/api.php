<?php

use App\Http\Controllers\Api\LeagueController;
use App\Http\Controllers\Api\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/standings', [LeagueController::class, 'standings']);
Route::get('/fixture', [LeagueController::class, 'fixture']);
Route::get('/championship-predictions', [LeagueController::class, 'championshipPredictions']);

Route::post('/simulate-all', [SimulationController::class, 'simulateAll']);
Route::post('/simulate-next', [SimulationController::class, 'simulateNext']);
Route::post('/reset', [SimulationController::class, 'reset']);
