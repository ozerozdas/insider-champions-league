<?php

namespace App\Strategies;

use App\Models\Team;

class RandomMatchResultStrategy implements MatchResultStrategyInterface
{
    public function simulate(Team $homeTeam, Team $awayTeam): array
    {
        return [
            'home_score' => rand(0, 3),
            'away_score' => rand(0, 3),
        ];
    }
}
