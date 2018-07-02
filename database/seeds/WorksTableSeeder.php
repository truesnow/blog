<?php

use Illuminate\Database\Seeder;
use App\Models\Work;

class WorksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $categories = array_keys(Work::$category_map);
        $works = factory(Work::class)->times(15)->make()->each(function ($work, $index) use ($categories, $faker) {
            $work->category = $faker->randomElement($categories);
        });

        Work::insert($works->toArray());
    }

}
