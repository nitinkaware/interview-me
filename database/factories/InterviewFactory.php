<?php

/** @var Factory $factory */

use App\Candidate;
use App\Interview;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Interview::class, function (Faker $faker) {
    return [
        'candidate_id' => function () {
            return factory(Candidate::class)->create();
        },
        'interviewer_id' => function () {
            return factory(User::class);
        },
    ];
});
