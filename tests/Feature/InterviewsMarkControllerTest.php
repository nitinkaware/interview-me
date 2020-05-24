<?php

namespace Tests\Feature;

use App\Interview;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Airlock\Airlock;
use Tests\TestCase;

class InterviewsMarkControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_interviewer_must_be_logged_in_in_before_doing_anything()
    {
        /** @var Interview $unknownInterview */
        $unknownInterview = factory(Interview::class)->create();

        $this->putJson("/api/interviews/{$unknownInterview->getKey()}/mark")
            ->assertStatus(401);
    }

    /**
     * @test
     */
    public function only_the_assigned_interviews_to_interviewer_can_be_started()
    {
        Airlock::actingAs(factory(User::class)->create());

        /** @var Interview $unknownInterview */
        $unknownInterview = factory(Interview::class)->create();

        $this->putJson("/api/interviews/{$unknownInterview->getKey()}/mark")
            ->assertStatus(403);

        $this->assertFalse($unknownInterview->fresh()->isStarted());
    }

    /**
     * @test
     */
    public function an_interviewer_can_start_the_interview()
    {
        Airlock::actingAs($user = factory(User::class)->create());

        /** @var Interview $interview */
        $interview = factory(Interview::class)->create(['interviewer_id' => $user->getKey()]);

        $this->putJson("/api/interviews/{$interview->getKey()}/mark")
            ->assertStatus(202);

        $this->assertTrue($interview->fresh()->isStarted());
    }

    /**
     * @test
     */
    public function an_interviewer_can_complete_the_interview()
    {
        Airlock::actingAs($user = factory(User::class)->create());

        /** @var Interview $interview */
        $interview = factory(Interview::class)->create(['interviewer_id' => $user->getKey()]);

        $this->deleteJson("/api/interviews/{$interview->getKey()}/mark")
            ->assertStatus(202);

        $this->assertTrue($interview->fresh()->isCompleted());
    }
}
