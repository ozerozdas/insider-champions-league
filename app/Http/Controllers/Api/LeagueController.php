<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LeagueTableService;
use App\Services\MatchService;
use App\Services\PredictionService;

class LeagueController extends Controller
{
    public function standings()
    {
        $standings = LeagueTableService::getTable();
        return response()->json($standings);
    }

    public function fixture()
    {
        $fixture = MatchService::getFixture();
        return response()->json($fixture);
    }

    public function championshipPredictions()
    {
        $predictions = (new PredictionService())->getOdds();
        return response()->json($predictions);
    }
}
