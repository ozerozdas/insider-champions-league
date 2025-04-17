<?php

namespace App\Strategies;

use App\Models\Team;

interface MatchResultStrategyInterface
{
    public function simulate(Team $homeTeam, Team $awayTeam): array;
}
