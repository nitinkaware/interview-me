<?php

use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Candidate::all()->each(function($candidate) {
            \App\Interview::create([
                'candidate_id' => $candidate->getKey(),
                'interviewer_id' => App\User::inRandomOrder()->first()->id
            ]);
        });

        \App\Interview::create([
            'candidate_id' => \App\Candidate::whereName('James Sinha')->first()->getKey(),
            'interviewer_id' => App\User::whereName('Nitin Kaware')->first()->id
        ]);
    }
}
