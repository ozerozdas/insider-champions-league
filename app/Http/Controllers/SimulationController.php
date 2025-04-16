<?php

namespace App\Http\Controllers;

use App\Services\MatchService;
use Inertia\Inertia;

class SimulationController extends Controller
{
    public function start()
    {
        $status = MatchService::createFixture();
        return redirect()->route('simulation.dashboard')->with([
            'message' => $status ? 'Fixture created successfully' : 'Failed to create fixture',
        ], $status ? 200 : 500);
    }

    public function index()
    {
        $fixture = MatchService::getFixture();
        return Inertia::render('Simulation/Dashboard', [
            'fixture' => $fixture,
        ]);
    }
}
