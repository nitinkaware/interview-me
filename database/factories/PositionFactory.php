<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Position::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
