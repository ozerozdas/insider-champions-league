<?php

use App\Strategies\RandomMatchResultStrategy;
use App\Models\Team;

it('returns random score between 0-3', function () {
    $strategy = new RandomMatchResultStrategy();

    $home = Team::inRandomOrder()->first();
    $away = Team::where('id', '!=', $home->id)->inRandomOrder()->first();

    $result = $strategy->simulate($home, $away);

    expect($result['home_score'])->toBeGreaterThanOrEqual(0)->toBeLessThanOrEqual(3);
    expect($result['away_score'])->toBeGreaterThanOrEqual(0)->toBeLessThanOrEqual(3);
});
