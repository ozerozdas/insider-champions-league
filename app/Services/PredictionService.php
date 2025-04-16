<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamMatch;

class PredictionService
{
    public static function getOdds()
    {
        $matches = TeamMatch::unplayed()->get();
        $teams = Team::with(['homeMatches', 'awayMatches'])->get();

        $odds = self::calculateOddsWithWeights($teams, $matches);
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
    }

    private static function calculateOddsWithWeights($teams, $matches, $simCount = 1000)
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

            $table = self::computeTableFromSimulatedMatches($teams, $simulatedMatches);
            $champion = $table->first()['team_id'];

            $odds->put($champion, $odds->get($champion) + 1);
        }

        return $odds->map(fn($v) => round(($v / $simCount) * 100, 2));
    }

    private static function computeTableFromSimulatedMatches($teams, $simulatedMatches)
    {
        $table = [];

        foreach ($teams as $team) {
            $table[$team->id] = [
                'team_id' => $team->id,
                'team_name' => $team->name,
                'played' => 0,
                'won' => 0,
                'drawn' => 0,
                'lost' => 0,
                'gf' => 0,
                'ga' => 0,
                'gd' => 0,
                'points' => 0,
            ];
        }

        foreach ($simulatedMatches as $match) {
            $home = &$table[$match['home_id']];
            $away = &$table[$match['away_id']];

            $homeScore = $match['home_score'];
            $awayScore = $match['away_score'];

            $home['played']++;
            $away['played']++;

            $home['gf'] += $homeScore;
            $home['ga'] += $awayScore;

            $away['gf'] += $awayScore;
            $away['ga'] += $homeScore;

            if ($homeScore > $awayScore) {
                $home['won']++;
                $away['lost']++;
                $home['points'] += 3;
            } elseif ($homeScore < $awayScore) {
                $away['won']++;
                $home['lost']++;
                $away['points'] += 3;
            } else {
                $home['drawn']++;
                $away['drawn']++;
                $home['points'] += 1;
                $away['points'] += 1;
            }
        }

        foreach ($table as &$team) {
            $team['gd'] = $team['gf'] - $team['ga'];
        }

        return collect($table)->sortByDesc('points');
    }
}
