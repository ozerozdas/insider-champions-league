<?php

namespace Tests;

use App\Factories\MatchFactory;
use App\Models\Team;
use Database\Seeders\TeamSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            TeamSeeder::class,
        ]);

        MatchFactory::createFixture(Team::get());
    }
}
