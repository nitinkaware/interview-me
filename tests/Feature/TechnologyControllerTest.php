<?php

namespace Tests\Feature;

use App\TechnologyStack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TechnologyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_tech_stack_can_be_created()
    {
        $technologyStack = factory(TechnologyStack::class)->make()->toArray();

        $this->postJson('/api/technologies', $technologyStack)
            ->assertStatus(201);

        $this->assertDatabaseHas('technology_stacks', $technologyStack);
    }

    /**
     * @test
     */
    public function a_tech_stack_can_be_updated()
    {
        $technologyStack = factory(TechnologyStack::class)->create();

        $this->putJson('/api/technologies/' . $technologyStack->getKey(), ['name' => 'JavaScript'])
            ->assertStatus(200);

        $this->assertDatabaseHas('technology_stacks', ['name' => 'JavaScript']);
    }

    /**
     * @test
     */
    public function a_tech_stack_can_be_deleted()
    {
        $technologyStack = factory(TechnologyStack::class)->create();

        $this->deleteJson('/api/technologies/' . $technologyStack->getKey())
            ->assertStatus(200);

        $this->assertDatabaseMissing('technology_stacks', $technologyStack->toArray());
    }
}
