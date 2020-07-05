<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Milestone::class, function (Faker $faker) {
    return [
        'version' => $faker->date('Y-m-d', 'now'),
        'content' => $faker->sentence(),
        'detail' => $faker->paragraph(),
        'type' => random_int(1, 4),
    ];
});
