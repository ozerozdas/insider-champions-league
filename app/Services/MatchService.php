<?php

namespace App\Services;

use App\Factories\MatchFactory;
use App\Models\Team;
use App\Models\TeamMatch;
use Illuminate\Support\Collection;

class MatchService
{
    public static function createFixture(): bool
    {
        try {
            $teams = Team::get()->toArray();
            MatchFactory::createFixture($teams);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getFixture(): Collection
    {
        return TeamMatch::get();
    }
}
