<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    public function store(Request $request)
    {
        return Position::create(
            $request->only('name')
        );
    }

    public function update(Request $request)
    {
        $request->position->update(
            $request->only('name')
        );

        return response()->json();
    }

    public function destroy(Request $request)
    {
        $request->position->delete();

        return response()->json();
    }
}
