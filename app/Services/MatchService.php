<?php

namespace App\Services;

use App\Factories\MatchFactory;
use App\Models\Team;
use App\Models\TeamMatch;
use App\Strategies\MatchResultStrategyInterface;
use App\Strategies\WeightedMatchResultStrategy;
use Illuminate\Support\Collection;

class MatchService
{
    public static function getTeams(): Collection
    {
        return Team::get();
    }

    public static function createFixture(): bool
    {
        try {
            MatchFactory::createFixture(self::getTeams());
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getFixture(): Collection
    {
        return TeamMatch::get();
    }

    public static function weightedScore(Team $home, Team $away): array
    {
        $homePower = $home->strength + ($home->points * 2) + ($home->goal_diff ?? 0);
        $awayPower = $away->strength + ($away->points * 2) + ($away->goal_diff ?? 0);

        $total = $homePower + $awayPower;
        $homeProb = $homePower / $total;
        $awayProb = $awayPower / $total;

        $rand = rand(1, 1000) / 1000;

        if ($rand < $homeProb) {
            return ['home_score' => rand(1, 3), 'away_score' => rand(0, 2)];
        } elseif ($rand < $homeProb + $awayProb) {
            return ['home_score' => rand(0, 2), 'away_score' => rand(1, 3)];
        } else {
            return ['home_score' => rand(0, 2), 'away_score' => rand(0, 2)];
        }
    }

    public static function simulateMatch(TeamMatch $match, ?MatchResultStrategyInterface $strategy = null): void
    {
        $strategy = $strategy ?? new WeightedMatchResultStrategy();

        $home = $match->homeTeam;
        $away = $match->awayTeam;

        $result = $strategy->simulate($home, $away);
        
        $match->update([
            'home_score' => $result['home_score'],
            'away_score' => $result['away_score'],
            'is_played' => true,
        ]);

        PredictionService::forgetOdds();
    }
}
