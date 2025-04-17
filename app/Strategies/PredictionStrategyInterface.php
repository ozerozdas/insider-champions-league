<?php

namespace App\Strategies;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface PredictionStrategyInterface
{
    public function calculate(EloquentCollection $teams, EloquentCollection $matches): Collection;
}
