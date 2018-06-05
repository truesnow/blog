<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $time = $faker->dateTimeThisMonth();
    return [
        'content' => $faker->sentence(),
        'like' => $faker->randomDigit(),
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
