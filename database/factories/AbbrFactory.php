<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Abbr::class, function (Faker $faker) {
    return [
        'abbr' => str_random(random_int(2, 5)),
        'full_name' => $faker->name(),
        'cn_name' => $faker->name(),
        'desc' => $faker->sentence()
    ];
});
