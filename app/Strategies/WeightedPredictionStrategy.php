<?php

namespace App\Strategies;

use App\Services\MatchService;
use App\Support\LeagueTableHelper;
use Illuminate\Support\Collection;

class WeightedPredictionStrategy implements PredictionStrategyInterface
{
    public function calculate($teams, $matches, $simCount = 1000): Collection
    {
        $odds = collect($teams)->mapWithKeys(fn($team) => [$team->id => 0]);

        for ($i = 0; $i < $simCount; $i++) {
            $simulatedMatches = [];

            foreach ($matches as $match) {
                $result = MatchService::weightedScore($match->homeTeam, $match->awayTeam);

                $simulatedMatches[] = [
                    'home_id' => $match->home_team_id,
                    'away_id' => $match->away_team_id,
                    'home_score' => $result['home_score'],
                    'away_score' => $result['away_score'],
                ];
            }

            $table = LeagueTableHelper::compute($teams, $simulatedMatches);
            $champion = $table->first()['team_id'];

            $odds->put($champion, $odds->get($champion) + 1);
        }

        return $odds->map(fn($v) => round(($v / $simCount) * 100, 2));
    }
}
