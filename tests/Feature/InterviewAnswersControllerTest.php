<?php

namespace Tests\Feature;

use App\Interview;
use App\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Airlock\Airlock;
use Tests\TestCase;

class InterviewAnswersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function you_must_be_logged_in()
    {
        /** @var Interview $interview */
        $interview = factory(Interview::class)->create();

        /** @var Question $question */
        $question = factory(Question::class)->create();

        $this->postJson("/api/interviews/{$interview->getKey()}/answer", [
            'question_id' => $question->getKey(),
            'rating' => 7,
            'answer' => '',
        ])->assertStatus(401);
    }

    /**
     * @test
     */
    public function an_interviewer_should_submit_the_question_with_answers()
    {
        /** @var Interview $interview */
        $interview = factory(Interview::class)->create();
        $interview->markAsStarted();

        /** @var Question $question */
        $question = factory(Question::class)->create();

        Airlock::actingAs($interview->interviewer);

        $this->postJson("/api/interviews/{$interview->getKey()}/answer", [
            'question_id' => $question->getKey(),
            'rating' => 7,
            'answer' => '',
        ])->assertStatus(201);

        $this->assertCount(1, $interview->answers()->get());
    }

    /**
     * @test
     */
    public function interview_should_be_started_in_order_to_submit_the_question()
    {
        /** @var Interview $interview */
        $interview = factory(Interview::class)->create();

        /** @var Question $question */
        $question = factory(Question::class)->create();

        Airlock::actingAs($interview->interviewer);

        $this->postJson("/api/interviews/{$interview->getKey()}/answer", [
            'question_id' => $question->getKey(),
            'rating' => 7,
            'answer' => '',
        ])->assertStatus(403);

        $this->assertCount(0, $interview->answers()->get());
    }

    /**
     * @test
     */
    public function if_the_interview_is_already_ended_then_questions_answer_should_not_be_submitted()
    {
        /** @var Interview $interview */
        $interview = factory(Interview::class)->create();
        $interview->markAsStarted()
            ->markAsCompleted();

        /** @var Question $question */
        $question = factory(Question::class)->create();

        Airlock::actingAs($interview->interviewer);

        $this->postJson("/api/interviews/{$interview->getKey()}/answer", [
            'question_id' => $question->getKey(),
            'rating' => 7,
            'answer' => '',
        ])->assertStatus(403);

        $this->assertCount(0, $interview->answers()->get());
    }
}
