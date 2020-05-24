<?php

namespace Tests\Feature;

use App\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CandidateWithTechStack;

class CandidatesControllerTest extends TestCase
{
    use RefreshDatabase, CandidateWithTechStack;

    /**
     * @test
     */
    public function a_candidate_can_be_created()
    {
        $response = $this->postJson('/api/candidates', $candidate = $this->candidateWithTechStackPayload());

        $response->assertStatus(201);

        $this->assertDatabaseHas('candidates', ['name' => $candidate['name'], 'position_id' => $candidate['position_id']]);
    }

    /**
     * @test
     */
    public function a_candidate_can_be_updated()
    {
        $candidate = factory(Candidate::class)->create();

        $response = $this->putJson('/api/candidates/'.$candidate->getKey(), [
            'name' => 'Nitin',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('candidates', [
            'name' => 'Nitin',
        ]);
    }

    /**
     * @test
     */
    public function a_candidate_can_be_deleted()
    {
        $candidate = factory(Candidate::class)->create();

        $response = $this->deleteJson('/api/candidates/'.$candidate->getKey());

        $response->assertStatus(200);

        $this->assertDatabaseMissing('candidates', $candidate->toArray());
    }
}
