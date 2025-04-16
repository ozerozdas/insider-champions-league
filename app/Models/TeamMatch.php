<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'week',
        'home_score',
        'away_score',
        'is_played',
    ];

    protected $casts = [
        'home_team_id' => 'integer',
        'away_team_id' => 'integer',
        'week' => 'integer',
        'home_score' => 'integer',
        'away_score' => 'integer',
        'is_played' => 'boolean',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function scopePlayed($query)
    {
        return $query->where('is_played', true);
    }

    public function scopeUnplayed($query)
    {
        return $query->where('is_played', false);
    }
}
