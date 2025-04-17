<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\LeagueSimulatorService;

class SimulationController extends Controller
{
    public function simulateAll(): JsonResponse
    {
        $status = (new LeagueSimulatorService())->simulateAllMatches();
        return response()->json([
            'message' => $status ? 'All matches simulated' : 'Failed to simulate matches',
        ], $status ? 200 : 500);
    }

    public function simulateNext(): JsonResponse
    {
        $status = (new LeagueSimulatorService())->simulateNextWeek();
        return response()->json([
            'message' => $status ? 'Next week simulated' : 'Failed to simulate matches',
        ], $status ? 200 : 500);
    }

    public function reset(): JsonResponse
    {
        $status = (new LeagueSimulatorService())->resetLeague();
        return response()->json([
            'message' => $status ? 'Data reset' : 'Failed to reset data',
        ], $status ? 200 : 500);
    }
}
