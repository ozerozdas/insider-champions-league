<?php

use App\Strategies\WeightedMatchResultStrategy;
use App\Models\Team;

it('biases results toward stronger team', function () {
    $strategy = new WeightedMatchResultStrategy();

    $strongTeam = Team::orderBy('strength', 'desc')->first();
    $weakTeam = Team::orderBy('strength', 'asc')->first();

    $results = collect();

    for ($i = 0; $i < 100; $i++) {
        $res = $strategy->simulate($strongTeam, $weakTeam);
        $results->push($res['home_score'] > $res['away_score']);
    }

    $winRatio = $results->filter()->count() / $results->count();

    expect($winRatio)->toBeGreaterThan(0.4);
});
