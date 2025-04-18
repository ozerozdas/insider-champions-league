<?php

namespace App\Http\Controllers;

use App\Services\MatchService;

class HomeController extends Controller
{
    public function __invoke()
    {
        return inertia('Home', [
            'teams' => MatchService::getTeams()
        ]);
    }
}
