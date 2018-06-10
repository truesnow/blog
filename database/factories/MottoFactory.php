<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Motto::class, function (Faker $faker) {
    $date_time = $faker->dateTimeThisMonth();
    return [
        'author' => $faker->name,
        'source' => '《' . $faker->name . '》',
        'portrait' => $faker->imageUrl(100, 100),
        'content' => $faker->sentence,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
