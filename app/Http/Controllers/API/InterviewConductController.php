<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class InterviewConductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('conduct', $request->interview);
        $tags = $request->interview->candidate->technologyStack()->get(['name', 'id']);

        return [
            'candidate' => $request->interview->candidate->only('name', 'id'),
            'position' => $request->interview->candidate->position->only('name', 'id'),
            'questions' => Question::with('technologyStack:name,id')->withAnswersFor($request->interview->id)->forTechStacks($tags->pluck('id'))->get(['name', 'id'])
        ];
    }

    public function store(Request $request)
    {
        $this->authorize('conduct', $request->interview);

        $request
            ->question
            ->saveAnswerForInterview($request->interview, $request->only(['rating', 'answer']));

        return response()->noContent();
    }
}
