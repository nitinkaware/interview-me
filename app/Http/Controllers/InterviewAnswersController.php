<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewAnswerRequest;

class InterviewAnswersController extends Controller
{
    public function store(InterviewAnswerRequest $request)
    {
        $this->authorize('answer', $request->interview);

        return $request
            ->interview
            ->addAnswer(
                $request->only('question_id', 'rating', 'answer')
            );
    }
}
