<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User interviewer
 */
class Interview extends Model
{
    protected $guarded = [];

    protected $casts = [
        'started_at' => 'date',
        'interviewer_id' => 'int',
        'candidate_id' => 'int'
    ];

    public function markAsStarted()
    {
        $this->update([
            'started_at' => now(),
        ]);

        return $this;
    }

    public function markAsCompleted()
    {
        $this->update([
            'completed_at' => now(),
        ]);

        return $this;
    }

    public function isStarted()
    {
        return $this->started_at !== null;
    }

    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    public function scopeNotStarted(Builder $query)
    {
        $query->where('started_at', null);
    }

    public function scopeNotCompleted(Builder $query)
    {
        $query->where('completed_at', null);
    }

    public function scopeInterviewsScheduledWith(Builder $query, $user)
    {
        $query->whereHas('interviewer', function($query) use ($user) {
            $query->where('interviewer_id', $user->getKey());
        });
    }

    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function answers()
    {
        return $this->hasMany(InterviewAnswer::class);
    }

    public function addAnswer(array $payload)
    {
        return $this->answers()
                ->create($payload);
    }
}
