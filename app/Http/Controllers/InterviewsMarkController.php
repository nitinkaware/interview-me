<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewsMarkController extends Controller
{
    public function update(Request $request)
    {
        $this->authorize('update', $request->interview);

        $request->interview
            ->markAsStarted();

        return response()->json([], 202);
    }

    public function destroy(Request $request)
    {
        $this->authorize('destroy', $request->interview);

        $request->interview
            ->markAsCompleted();

        return response()->json([], 202);
    }
}
