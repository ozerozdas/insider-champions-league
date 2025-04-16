<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Collection;

class LeagueTableService
{
    public static function getTable(): Collection
    {
        $teams = Team::with(['homeMatches', 'awayMatches'])->get();

        $table = $teams->map(function (Team $team) {
            $played = 0;
            $won = 0;
            $drawn = 0;
            $lost = 0;
            $gf = 0;
            $ga = 0;

            foreach ($team->homeMatches as $match) {
                if (!$match->is_simulated) continue;

                $played++;
                $gf += $match->home_score;
                $ga += $match->away_score;

                if ($match->home_score > $match->away_score) $won++;
                elseif ($match->home_score == $match->away_score) $drawn++;
                else $lost++;
            }

            foreach ($team->awayMatches as $match) {
                if (!$match->is_simulated) continue;

                $played++;
                $gf += $match->away_score;
                $ga += $match->home_score;

                if ($match->away_score > $match->home_score) $won++;
                elseif ($match->away_score == $match->home_score) $drawn++;
                else $lost++;
            }

            $points = $won * 3 + $drawn;

            return [
                'team' => $team->name,
                'played' => $played,
                'won' => $won,
                'drawn' => $drawn,
                'lost' => $lost,
                'gf' => $gf,
                'ga' => $ga,
                'gd' => $gf - $ga,
                'points' => $points,
            ];
        });

        return $table->sortByDesc('points');
    }
}
