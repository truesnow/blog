<?php

use App\Models\WikiCate;
use Faker\Generator as Faker;

$factory->define(App\Models\WikiCate::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'desc' => $faker->sentence(20),
        'resource_type' => $faker->randomElement(array_keys(WikiCate::RESOURCE_TYPE_MAP)),
        'ordinal' => $faker->numberBetween(10, 1000),
        'enable_status' => $faker->randomElement([0, 1]),
    ];
});
