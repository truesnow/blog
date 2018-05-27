<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Message::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'content' => $faker->paragraph,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
