<?php

return [
    'prediction' => [
        'strategy' => in_array(($strategy = env('PREDICTION_STRATEGY', 'weighted')), ['random', 'weighted'], true)
            ? strtolower($strategy)
            : 'weighted',
    ],
];
