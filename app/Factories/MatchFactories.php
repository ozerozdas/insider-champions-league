<?php

namespace App\Factories;

use App\Models\TeamMatch;

class MatchFactory
{
    public static function createFixture(array $teams): void
    {
        $week = 1;

        for ($i = 0; $i < count($teams); $i++) {
            for ($j = $i + 1; $j < count($teams); $j++) {
                TeamMatch::create([
                    'home_team_id' => $teams[$i]->id,
                    'away_team_id' => $teams[$j]->id,
                    'week' => $week++,
                ]);
            }
        }
    }
}
