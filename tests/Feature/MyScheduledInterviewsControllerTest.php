<?php

namespace Tests\Feature;

use App\Interview;
use App\TechnologyStack;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Airlock\Airlock;
use Tests\TestCase;

class MyScheduledInterviewsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_return_me_all_my_scheduled_interviews()
    {
        $this->withoutExceptionHandling();

        Airlock::actingAs($user = factory(User::class)->create());

        $anatherUser = factory(User::class)->create();

        /** @var Interview $interview */
        $interview = factory(Interview::class, 3)->create(['interviewer_id' => $user->getKey()]);

        factory(Interview::class, 3)->create(['interviewer_id' => $anatherUser->getKey()]);

        $techStack = factory(TechnologyStack::class, 3)->create();

        $interview->each(function($i) use ($techStack) {
            $i->candidate->technologyStack()->attach($techStack);
        });

        $this->getJson('/api/my/interviews/')
            ->assertOk()
            ->assertJsonCount(3);
    }
}
