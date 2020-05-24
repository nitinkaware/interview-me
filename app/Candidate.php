<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = [];

    public function technologyStack()
    {
        return $this->belongsToMany(TechnologyStack::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function addTechStack($ids)
    {
        $this->technologyStack()->attach($ids);
    }

    public function scopeInterviewsScheduledWith(Builder $query, $user)
    {
        $query->whereHas('interviews', function($query) use ($user) {
            $query->where('interviewer_id', $user->getKey());
        });
    }

    public function scopeNotStarted(Builder $query)
    {
        $query->where('started_at', null);
    }

    public function scopeNotCompleted(Builder $query)
    {
        $query->where('completed_at', null);
    }
}
