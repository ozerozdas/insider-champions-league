<?php

namespace App\Strategies;

use Illuminate\Support\Collection;
use App\Support\LeagueTableHelper;

class RandomPredictionStrategy implements PredictionStrategyInterface
{
    public function calculate($teams, $matches, $simCount = 1000): Collection
    {
        $odds = collect($teams)->mapWithKeys(fn($team) => [$team->id => 0]);

        for ($i = 0; $i < 1000; $i++) {
            $simulated = $matches->map(function ($match) {
                return [
                    'home_id' => $match->home_team_id,
                    'away_id' => $match->away_team_id,
                    'home_score' => rand(0, 3),
                    'away_score' => rand(0, 3),
                ];
            });

            $table = LeagueTableHelper::compute($teams, $simulated->all());
            $champion = $table->first()['team_id'];

            $odds->put($champion, $odds->get($champion) + 1);
        }

        return $odds->map(fn($v) => round($v / 10, 2));
    }
}
