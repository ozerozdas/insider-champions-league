<?php

namespace App\Strategies;

use App\Models\Team;

class WeightedMatchResultStrategy implements MatchResultStrategyInterface
{
    public function simulate(Team $homeTeam, Team $awayTeam): array
    {
        $homeWeight = $homeTeam->strength + ($homeTeam->points ?? 0) * 2;
        $awayWeight = $awayTeam->strength + ($awayTeam->points ?? 0) * 2;

        $total = $homeWeight + $awayWeight;
        $homeChance = $homeWeight / $total;

        $random = mt_rand() / mt_getrandmax();

        if ($random < $homeChance) {
            return [
                'home_score' => rand(1, 3),
                'away_score' => rand(0, 1),
            ];
        } elseif ($random < $homeChance + (1 - $homeChance) * 0.2) {
            return [
                'home_score' => rand(0, 1),
                'away_score' => rand(0, 1),
            ];
        } else {
            return [
                'home_score' => rand(0, 1),
                'away_score' => rand(1, 3),
            ];
        }
    }
}
