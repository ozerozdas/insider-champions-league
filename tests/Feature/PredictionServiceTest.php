<?php

use App\Services\PredictionService;
use App\Strategies\WeightedPredictionStrategy;

it('calculates championship odds using WeightedPredictionStrategy', function () {
    $service = new PredictionService(new WeightedPredictionStrategy());
    $odds = $service->getOdds();

    expect($odds)->toBeArray();
    expect($odds)->toHaveCount(4);
    expect($odds[0])->toHaveKeys(['id', 'name', 'odds']);
});