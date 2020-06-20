<?php

use App\Models\Milestone;
use Illuminate\Database\Seeder;

class MilestonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $milestones = factory(Milestone::class)->times(100)->make()->each(function ($milestone) use ($faker) {

        });
        Milestone::insert($milestones->toArray());
    }
}
