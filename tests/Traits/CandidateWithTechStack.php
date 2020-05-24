<?php

namespace Tests\Traits;

use App\Candidate;
use App\Position;
use App\TechnologyStack;

trait CandidateWithTechStack {

    public function candidateWithTechStackPayload()
    {
        $candidate = factory(Candidate::class)->make()->toArray();

        $techStack = factory(TechnologyStack::class, 3)->create();

        $position = factory(Position::class)->create(['name' => 'Senior PHP Developer']);

        $candidate['technologies_id'] = $techStack->pluck('id');
        $candidate['position_id'] = $position->getKey();

        return $candidate;
    }
}
