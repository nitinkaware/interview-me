<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static forTechStacks($pluck)
 */
class Question extends Model
{
    public function technologyStack()
    {
        return $this->belongsToMany(TechnologyStack::class);
    }

    public function answer()
    {
        return $this->hasOne(InterviewAnswer::class);
    }

    public function saveAnswerForInterview(Interview $interview, array $payload)
    {
        return $this->answer()->firstOrNew([
            'interview_id' => $interview->getKey()
        ])->forceFill($payload)->save();
    }

    public function scopeWithAnswersFor(Builder $query, $interviewId)
    {
        $query->with(['answer' => function(HasOne $query) use ($interviewId){
            $query->where('interview_id', $interviewId);
        }]);
    }

    public function scopeForTechStacks(Builder $query, $techStackIds)
    {
        $query->whereHas('technologyStack', function(Builder $query) use ($techStackIds) {
            $query->whereIn('id', $techStackIds);
        });
    }
}
