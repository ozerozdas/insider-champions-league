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

    protected $appends = [
        'winCount',
        'loseCount',
    ];

    public function homeMatches()
    {
        return $this->hasMany(TeamMatch::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(TeamMatch::class, 'away_team_id');
    }

    public function getWinCountAttribute()
    {
        return $this->homeMatches()
            ->whereRaw('CAST(home_score AS INTEGER) > CAST(away_score AS INTEGER)')
            ->count() +
            $this->awayMatches()
            ->whereRaw('CAST(away_score AS INTEGER) > CAST(home_score AS INTEGER)')
            ->count();
    }

    public function getLoseCountAttribute()
    {
        return $this->homeMatches()
            ->whereRaw('CAST(home_score AS INTEGER) < CAST(away_score AS INTEGER)')
            ->count() +
            $this->awayMatches()
            ->whereRaw('CAST(away_score AS INTEGER) < CAST(home_score AS INTEGER)')
            ->count();
    }
}
