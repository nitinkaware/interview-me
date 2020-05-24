<?php

namespace Tests\Unit;

use App\Candidate;
use App\Question;
use App\TechnologyStack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_candidate_has_questions()
    {
        /** @var Candidate $candidate */
        $candidate = factory(Candidate::class)->create();

        /** @var Question $question1 */
        $question1 = factory(Question::class)->create(['name' => 'What is PHP']);

        /** @var Question $question2 */
        $question2 = factory(Question::class)->create(['name' => 'What is JavaScript']);

        /** @var TechnologyStack $techStack1 */
        $techStack1 = factory(TechnologyStack::class)->create(['name' => 'PHP']);

        /** @var TechnologyStack $techStack2 */
        $techStack2 = factory(TechnologyStack::class)->create(['name' => 'JavaScript']);

        // Add two tech stack for candidate.
        $candidate->technologyStack()->attach([$techStack1->getKey(), $techStack2->getKey()]);

        // Add questions to these stack.
        $techStack1->questions()->attach($question1);
        $techStack2->questions()->attach($question2);

        $this->assertCount(2, $candidate->questions());
    }
}
