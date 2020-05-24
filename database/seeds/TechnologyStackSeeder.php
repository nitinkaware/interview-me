<?php

use Illuminate\Database\Seeder;

class TechnologyStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['PHP', 'JavaScript', '.Net', 'MySql', 'AWS', 'Java', 'VueJs', 'ReactJs'] as $name) {
            \App\TechnologyStack::create([
                'name' => $name
            ]);
        }
    }
}
