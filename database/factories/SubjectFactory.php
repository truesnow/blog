<?php

use Faker\Generator as Faker;
use App\Models\Subject;

$factory->define(Subject::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween('-4 years', 'now');
    $updated_at = $faker->dateTimeBetween($created_at, 'now');
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'parent_id' => 0,
        'article_count' => 0,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
