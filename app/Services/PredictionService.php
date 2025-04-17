<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamMatch;
use App\Strategies\RandomPredictionStrategy;
use App\Strategies\WeightedPredictionStrategy;

class PredictionService
{
    public function getOdds()
    {
        self::forgetOdds();
        $strategy = match (config('league.prediction.strategy')) {
            'random' => new RandomPredictionStrategy(),
            'weighted' => new WeightedPredictionStrategy(),
            default => throw new \InvalidArgumentException('Invalid prediction strategy'),
        };

        return cache()->rememberForever('odds', function () use ($strategy) {
            $matches = TeamMatch::unplayed()->get();
            if ($matches->isEmpty()) {
                $standings = LeagueTableService::getTable();
                return $standings->map(function ($value, $key) {
                    return [
                        'id' => $key,
                        'name' => $value['team'],
                        'odds' => $key === 0 ? 100 : 0,
                        'winCount' => 0,
                        'loseCount' => 0,
                    ];
                });
            }
            $teams = Team::with(['homeMatches', 'awayMatches'])->get();

            $odds = $strategy->calculate($teams, $matches);
            $odds = $odds->map(function ($value, $key) use ($teams) {
                $team = $teams->find($key);
                $adjustedOdds = $value;

                if ($team && $team->winCount > 0) {
                    $adjustedOdds *= (1 + ($team->winCount * 0.30));
                }
                if ($team && $team->loseCount > 0) {
                    $adjustedOdds *= (1 - ($team->loseCount * 0.15));
                }

                return [
                    'id' => $key,
                    'name' => $team->name ?? 'Unknown',
                    'odds' => (float) number_format($adjustedOdds, 2, '.', ''),
                    'winCount' => $team->winCount ?? 0,
                    'loseCount' => $team->loseCount ?? 0,
                ];
            });

            $odds = $odds->sortByDesc('odds')->values()->all();

            return $odds;
        });
    }

    public static function forgetOdds(): void
    {
        cache()->forget('odds');
    }
}
