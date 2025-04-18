<?php

namespace App\Http\Controllers;

use App\Services\MatchService;
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
        return Inertia::render('Simulation/Dashboard', [
            'isLeagueCompleted' => MatchService::isLeagueCompleted(),
        ]);
    }
}
