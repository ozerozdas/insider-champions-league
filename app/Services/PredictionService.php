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
        $strategy = match (config('league.prediction.strategy')) {
            'random' => new RandomPredictionStrategy(),
            'weighted' => new WeightedPredictionStrategy(),
            default => throw new \InvalidArgumentException('Invalid prediction strategy'),
        };

        return cache()->remember('odds', now()->addDays(1), function () use ($strategy) {
            $matches = TeamMatch::unplayed()->get();
            $teams = Team::with(['homeMatches', 'awayMatches'])->get();

            $odds = $strategy->calculate($teams, $matches);
            $odds = $odds->sortByDesc(fn($v, $k) => $v)->map(fn($v, $k) => [
                'id' => $k,
                'name' => Team::find($k)->name,
                'odds' => $v,
            ]);
            $odds = $odds->values()->all();
            $odds = collect($odds)->sortByDesc('odds')->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'odds' => $item['odds'],
                ];
            });

            return $odds;
        });
    }

    public static function forgetOdds(): void
    {
        cache()->forget('odds');
    }
}
