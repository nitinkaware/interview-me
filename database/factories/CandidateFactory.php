<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Candidate::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position_id' => fn () => factory(\App\Position::class)->create(),
        'gender' => collect(['m', 'f'])->random(),
    ];
});
