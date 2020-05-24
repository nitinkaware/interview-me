<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class CandidateSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Candidate::create([
            'name' => 'James Sinha',
            'position_id' => \App\Position::whereName('Senior Software Engineer - PHP (PWA)')->first()->getKey()
        ]);

        \App\Candidate::create([
            'name' => 'Rahul Prabhu',
            'position_id' => \App\Position::whereName('Lead QA Engineer - Automation')->first()->getKey()
        ]);

        factory(\App\Candidate::class, 20)->create([
            'position_id' => \App\Position::inRandomOrder()->first()->id
        ]);
    }
}
