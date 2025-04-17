<?php

use App\Strategies\WeightedPredictionStrategy;
use App\Models\Team;
use App\Models\TeamMatch;

it('returns prediction odds from weighted strategy', function () {
    $teams = Team::get();

    foreach ($teams as $i => $home) {
        foreach ($teams as $j => $away) {
            if ($i < $j) {
                TeamMatch::create([
                    'home_team_id' => $home->id,
                    'away_team_id' => $away->id,
                    'week' => $i + $j,
                ]);
            }
        }
    }

    $strategy = new WeightedPredictionStrategy();
    $odds = $strategy->calculate($teams, TeamMatch::unplayed()->get());

    expect($odds)->toHaveCount(4);
    foreach ($odds as $percent) {
        expect($percent)->toBeGreaterThanOrEqual(0)->toBeLessThanOrEqual(100);
    }
});
