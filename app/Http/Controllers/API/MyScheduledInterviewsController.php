<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interview;
use Illuminate\Http\Request;

class MyScheduledInterviewsController extends Controller
{
    public function index(Request $request)
    {
        return Interview::query()
            ->with('candidate.position')
            ->with('candidate.technologyStack')
            ->notCompleted()
            ->interviewsScheduledWith($request->user())
            ->get();
    }
}
