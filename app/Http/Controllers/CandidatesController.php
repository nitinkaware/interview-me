<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Position;
use App\TechnologyStack;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function create()
    {
        return [
            'positions' => Position::all(),
            'technologyStacks' => TechnologyStack::all(),
        ];
    }

    public function store(Request $request)
    {
        return tap(Candidate::create($request->only([
            'name',
            'gender',
            'position_id',
        ])))->addTechStack($request->technologies_id);
    }

    public function update(Request $request)
    {
        $request->candidate->update([
            'name' => $request->name,
        ]);

        return response()->json();
    }

    public function destroy(Request $request)
    {
        $request->candidate->delete();

        return response()->json();
    }
}
