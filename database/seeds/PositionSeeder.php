<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Senior Project Manager',
            'Senior Software Engineer - .Net',
            'Senior QA Engineer - Automation',
            'Technical Support Engineer',
            'Software Engineer - PHP',
            'Senior Legal Associate',
            'HR Administrator - Recruitment',
            'Senior Software Engineer - PHP (PWA)',
            'Lead QA Engineer - Automation',
            'Lead Software Engineer - PHP (PWA)',
            'Senior UI Engineer',
        ])->each(function($name) {
            \App\Position::create([
                'name' => $name
            ]);
        });
    }
}
