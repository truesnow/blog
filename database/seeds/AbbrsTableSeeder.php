<?php

use Illuminate\Database\Seeder;
use App\Models\Abbr;

class AbbrsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $abbrs = factory(Abbr::class)->times(50)->make()->each(function ($abbr, $index) use ($faker) {

        });

        Abbr::insert($abbrs->toArray());
    }
}
