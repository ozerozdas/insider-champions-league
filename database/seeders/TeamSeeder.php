<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'Arsenal', 'strength' => 85],
            ['name' => 'Fulham', 'strength' => 50],
            ['name' => 'Manchester City', 'strength' => 100],
            ['name' => 'Newcastle United', 'strength' => 70],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
