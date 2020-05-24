<?php

namespace Tests\Feature;

use App\Candidate;
use App\Interview;
use App\Question;
use App\TechnologyStack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterviewConductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_not_allow_if_the_interview_is_not_belongs_to_auth_user()
    {
        $interview = factory(Interview::class)->create();

        $this->prepareState();

        $this->getJson('api/interviews/' . $interview->getKey() . '/conduct')
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function it_should_not_allow_if_the_interview_is_already_finished()
    {
        $interview = $this->prepareState();

        $interview->markAsCompleted();

        $this->getJson('api/interviews/' . $interview->getKey() . '/conduct')
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function it_should_list_the_interview_questions_based_on_users_tech_stack()
    {
        $this->withoutExceptionHandling();

        $interview = $this->prepareState();

        $this->getJson('api/interviews/' . $interview->getKey() . '/conduct')
            ->assertOk()
            ->dump();
    }

    /**
     * @return Interview
     */
    public function prepareState(): Interview
    {
        $this->signIn();

        /** @var Candidate $candidate */
        $candidate = factory(Candidate::class)->create();

        /** @var Interview $interview */
        $interview = factory(Interview::class)->create([
            'candidate_id' => $candidate->getKey(),
            'interviewer_id' => auth()->id()
        ]);

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
        return $interview;
    }
}
