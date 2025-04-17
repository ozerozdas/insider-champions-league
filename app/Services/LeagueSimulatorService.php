<?php

namespace App\Services;

use App\Models\TeamMatch;
use App\Strategies\RandomMatchResultStrategy;
use App\Strategies\WeightedMatchResultStrategy;

class LeagueSimulatorService
{
    public function simulateAllMatches(): bool
    {
        try {
            $matches = TeamMatch::whereNull('home_score')->get();
            foreach ($matches as $match) {
                $this->simulateMatch($match);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function simulateNextWeek(): bool
    {
        try {
            $nextWeek = TeamMatch::unplayed()->min('week');
            $matches = TeamMatch::where('week', $nextWeek)->get();

            foreach ($matches as $match) {
                $this->simulateMatch($match);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetLeague(): bool
    {
        try {
            TeamMatch::query()->update([
                'home_score' => null,
                'away_score' => null,
                'is_played' => false,
            ]);
            PredictionService::forgetOdds();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function simulateMatch($match): void
    {
        $strategy = match (config('league.prediction.strategy')) {
            'random' => new RandomMatchResultStrategy(),
            'weighted' => new WeightedMatchResultStrategy(),
            default => throw new \InvalidArgumentException('Invalid simulation strategy'),
        };
        MatchService::simulateMatch($match, $strategy);
    }
}
