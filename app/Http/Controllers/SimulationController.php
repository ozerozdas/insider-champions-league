<?php

namespace App\Http\Controllers;

use App\Services\MatchService;
use App\Services\PredictionService;
use Inertia\Inertia;

class SimulationController extends Controller
{
    public function start()
    {
        sleep(3);
        $status = MatchService::createFixture();
        return $status
            ? redirect()->route('simulation.dashboard')
            : back()->withErrors('Failed to create fixture.');
    }

    public function index()
    {
        // dd((new PredictionService())->getOdds());
        return Inertia::render('Simulation/Dashboard', [
            'isLeagueCompleted' => MatchService::isLeagueCompleted(),
        ]);
    }
}
