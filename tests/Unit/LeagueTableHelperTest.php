<?php

use App\Support\LeagueTableHelper;
use App\Models\Team;

it('computes correct standings from simulated matches', function () {
    $teams = Team::get();
    $simulated = [
        ['home_id' => $teams[0]->id, 'away_id' => $teams[1]->id, 'home_score' => 2, 'away_score' => 1],
        ['home_id' => $teams[1]->id, 'away_id' => $teams[0]->id, 'home_score' => 0, 'away_score' => 3],
    ];

    $table = LeagueTableHelper::compute($teams, $simulated);

    expect($table)->toHaveCount(4);
    expect($table->first()['team_id'])->toBe($teams[0]->id);
    expect($table->first()['points'])->toBe(6);
});
