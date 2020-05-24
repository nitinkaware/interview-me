<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Airlock\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'designation'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interviews()
    {
        return $this->belongsToMany(
            Candidate::class,
            'interviews',
            'interviewer_id',
            'candidate_id'
        );
    }

    public function scheduledInterviews()
    {
        return $this->interviews()
            ->with('position')
            ->with('technologyStack')
            ->wherePivot('started_at', null)
            ->wherePivot('completed_at', null)
            ->withPivot('id')
            ->get();
    }
}
