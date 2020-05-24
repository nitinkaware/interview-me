<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(TechnologyStackSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(CandidateSeeder::class);
        $this->call(CandidateTechnologyStackSeeder::class);
        $this->call(InterviewSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
