<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $javaScriptTechStack = \App\TechnologyStack::whereName('JavaScript')->first();
        $phpTechStack = \App\TechnologyStack::whereName('PHP')->first();

        collect([
            'What is JavaScript',
            'What is pure function?',
            'What is first class function?',
            'What is closure'
        ])->each(function($question) use ($javaScriptTechStack) {
            \App\Question::create([
                'name' => $question,
            ])->technologyStack()->attach($javaScriptTechStack);
        });

        collect([
            'What is PHP',
            'What is latest version of php?',
            'Can we write private constructor in php?',
            'What is OOPs',
            'What is traits'
        ])->each(function($question) use ($phpTechStack) {
            \App\Question::create([
                'name' => $question,
            ])->technologyStack()->attach($phpTechStack);
        });
    }
}
