<?php

namespace App\Factories;

use App\Models\TeamMatch;
use App\Services\PredictionService;
use Illuminate\Support\Collection;

class MatchFactory
{
    public static function createFixture(Collection $teams): void
    {
        TeamMatch::truncate();
        PredictionService::forgetOdds();
        $totalTeams = count($teams);
        $totalWeeks = $totalTeams - 1;
        $matchesPerWeek = $totalTeams / 2;

        $schedule = [];
        for ($week = 0; $week < $totalWeeks; $week++) {
            $weekMatches = [];
            for ($match = 0; $match < $matchesPerWeek; $match++) {
                $home = ($week + $match) % ($totalTeams - 1);
                $away = ($totalTeams - 1 - $match + $week) % ($totalTeams - 1);

                if ($match === 0) {
                    $away = $totalTeams - 1;
                }

                $weekMatches[] = [
                    'home_team_id' => $teams[$home]['id'],
                    'away_team_id' => $teams[$away]['id'],
                    'week' => $week + 1,
                ];
            }
            $schedule[] = $weekMatches;
        }

        $reverseSchedule = [];
        foreach ($schedule as $weekMatches) {
            $reverseWeekMatches = [];
            foreach ($weekMatches as $match) {
                $reverseWeekMatches[] = [
                    'home_team_id' => $match['away_team_id'],
                    'away_team_id' => $match['home_team_id'],
                    'week' => $match['week'] + $totalWeeks,
                ];
            }
            $reverseSchedule[] = $reverseWeekMatches;
        }

        $fullSchedule = array_merge($schedule, $reverseSchedule);

        foreach ($fullSchedule as $weekMatches) {
            foreach ($weekMatches as $match) {
                TeamMatch::create($match);
            }
        }
    }
}
