<?php

namespace Tests;

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
    }
}
