<?php

namespace Tests\Feature;

use App\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PositionsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_position_can_be_created()
    {
        $position = factory(Position::class)->make();

        $this->postJson('/api/positions', $position->toArray())
            ->assertStatus(201);

        $this->assertDatabaseHas('positions', $position->toArray());
    }
}
