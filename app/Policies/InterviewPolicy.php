<?php

namespace App\Policies;

use App\Interview;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Interview $interview)
    {
        return $user->getKey() === $interview->interviewer_id;
    }

    public function destroy(User $user, Interview $interview)
    {
        return $user->getKey() === $interview->interviewer_id;
    }

    public function answer(User $user, Interview $interview)
    {
        return $interview->isStarted() && !$interview->isCompleted();
    }

    public function conduct(User $user, Interview $interview)
    {
        return $this->update($user, $interview) && (!$interview->isCompleted());
    }
}
