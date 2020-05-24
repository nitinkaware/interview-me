<?php

use Illuminate\Database\Seeder;

class CandidateTechnologyStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Candidate::all()->each(function(\App\Candidate $candidate) {
            $candidate->addTechStack(\App\TechnologyStack::inRandomOrder()->first());
        })->each(function(\App\Candidate $candidate) {
            $candidate->addTechStack(\App\TechnologyStack::inRandomOrder()->first());
        });
    }
}
