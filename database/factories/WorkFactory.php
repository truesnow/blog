<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Work::class, function (Faker $faker) {
    $date_time = $faker->dateTimeThisMonth();
    return [
        'name' => $faker->name,
        'url' => $faker->url,
        'description' => $faker->sentence,
        'image' => $faker->imageUrl(100, 100),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
