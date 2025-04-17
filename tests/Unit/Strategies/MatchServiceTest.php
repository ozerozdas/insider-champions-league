<?php

use App\Strategies\WeightedMatchResultStrategy;
use App\Models\Team;
use App\Models\TeamMatch;
use App\Services\MatchService;

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

    expect($winRatio)->toBeGreaterThan(0.5); // güçlü takım daha fazla kazanmalı
});

it('simulates a match', function () {
    $match = TeamMatch::get()->first();

    MatchService::simulateMatch($match);
    $match->refresh();
    expect($match->home_score)->toBeInt();
    expect($match->away_score)->toBeInt();
});
