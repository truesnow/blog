<?php

use Faker\Generator as Faker;

$factory->define(App\Models\WikiSubject::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'desc' => $faker->sentence(20),
        'cover' => $faker->imageUrl(100, 60),
        'ordinal' => $faker->numberBetween(10, 1000),
        'enable_status' => $faker->randomElement([0, 1]),
    ];
});
