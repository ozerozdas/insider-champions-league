<?php

namespace App\Support;

use Illuminate\Support\Collection;

class LeagueTableHelper
{
    public static function compute($teams, array $simulatedMatches): Collection
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
