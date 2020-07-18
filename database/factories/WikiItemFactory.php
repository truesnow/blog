<?php

use Faker\Generator as Faker;

$factory->define(App\Models\WikiItem::class, function (Faker $faker) {
    return [
        'subject_id' => $faker->randomDigitNot(0),
        'cate_id' => $faker->randomDigitNot(0),
        'name' => $faker->words(3, true),
        'desc' => $faker->sentence(20),
        'url' => $faker->url(),
        'content_id' => $faker->randomDigit(),
        'ordinal' => $faker->numberBetween(10, 1000),
        'enable_status' => $faker->randomElement([0, 1]),
    ];
});
