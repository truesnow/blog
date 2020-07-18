<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TextContent::class, function (Faker $faker) {
    return [
        'table' => 'wiki_item',
        'record_id' => $faker->unique()->randomDigitNot(0),
        'content' => $faker->text(),
    ];
});
