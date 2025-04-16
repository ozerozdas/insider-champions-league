<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'strength',
    ];

    protected $casts = [
        'strength' => 'integer',
    ];

    public function homeMatches()
    {
        return $this->hasMany(TeamMatch::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(TeamMatch::class, 'away_team_id');
    }
}
